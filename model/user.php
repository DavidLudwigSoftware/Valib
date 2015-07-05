<?php


class User
{
    const STATUS_UNVERIFIED = 0;
    const STATUS_ACTIVE     = 1;
    const STATUS_LOCKED     = 2;
    CONST STATUS_DELETED    = 3;

    private $_db;
    private $_login;
    private $_crypt;
    private $_tables;
    private $_columns;
    private $_email;

    public function __construct()
    {
        $this->_db    = Application::Instance()->database();
        $this->_crypt = Application::Instance()->cryptography();

        $config = Application::Instance()->configuration();

        $this->_login   = $config['user']['login'];
        $this->_tables  = $config['user']['tables'];
        $this->_columns = $config['user']['dbcolumns'];
        $this->_email   = $config['user']['email'];
    }

    public function isLoggedIn()
    {
        if ($this->currentSession())
        {
            $db = Application::Instance()->database();
            $session = $this->currentSession();

            $result = $db->select($this->_tables['users'], ['session'], $db->where([$this->_columns['session'] => $session]));

            if (!empty($result))
            {
                $dbSession = $result[0][$this->_columns['session']];

                if ($session === $dbSession && !empty($dbSession))

                    return True;
            }
        }

        return False;
    }

    public function currentSession()
    {
        $cookie = Application::Instance()->cookie();

        return $cookie->get($this->_login['cookie']);
    }

    public function currentUserId()
    {
        $db = Application::Instance()->database();

        $result = $db->select($this->_tables['users'], ['id'], $db->where([$this->_columns['session'] => $this->currentSession()]));

        return (!empty($result)) ? $result[0]['id'] : Null;
    }

    public function getUser($accountId)
    {
        $db = Application::Instance()->database();

        $result = $db->select($this->_tables['users'], '*', $db->where(['id' => $accountId]));

        return (!empty($result)) ? $result[0] : Null;
    }

    public function currentUser()
    {
        return $this->getUser($this->currentUserId());
    }

    public function sendVerificationEmail($accountId, $email)
    {
        $db    = Application::Instance()->database();
        $mail  = Application::Instance()->mail();
        $nav   = Application::Instance()->navigation();
        $t     = Application::Instance()->template();

        $path = dirname( $this->_email['verify']['template']);
        $file = basename($this->_email['verify']['template']);

        $subject    = $this->_email['verify']['subject'];
        $controller = $this->_email['verify']['controller'];

        $link = $this->createVerificationLink($accountId);

        $t->subject($subject);
        $t->url($nav->build($nav->baseUrl(), $controller, ['id' => $link]));

        $m = $mail->create($subject, $t->load($path, $file), True);

        $m->addAddress($email);
        $m->setFrom($this->_email['verify']['from'],
                    $this->_email['verify']['fromname']);

        $m->send();
    }

    public function verifyAccount($link)
    {
        $db = Application::Instance()->database();

        $result = $db->select($this->_tables['verifylinks'], ['id', 'user_id'], $db->where(['link' => $link]));

        if (!empty($result))
        {
            $id     = $result[0]['id'];
            $userId = $result[0]['user_id'];

            $db->delete($this->_tables['verifylinks'], $db->where(['id' => $id]));

            $result = $this->setAccountStatus($userId, self::STATUS_ACTIVE);

            return $result;
        }

        return False;
    }

    public function setAccountStatus($accountId, $status)
    {
        $db = Application::Instance()->database();

        $result = $db->update($this->_tables['users'], ['status' => $status], $db->where(['id' => $accountId]));

        return ($result->rowCount() > 0) ? True : False;
    }

    public function setAccountPassword($accountId, $password)
    {
        $hash = Application::Instance()->cryptography()->passwordHash($password);

        $db = Application::Instance()->database();

        $db->update($this->_tables['users'], [$this->_columns['password'] => $hash], $db->where(['id' => $accountId]));
    }

    public function createVerificationLink($accountId)
    {
        $db    = Application::Instance()->database();
        $crypt = Application::Instance()->cryptography();

        $link = $crypt->randomHash();

        $db->insert($this->_tables['verifylinks'], [$accountId, $link, time() + 60 * 60 * 24]);

        return $link;
    }

    public function register($values, $verifyEmail = Null)
    {
        $db    = $this->_db;
        $crypt = $this->_crypt;

        $result = $db->query("SHOW COLUMNS FROM `" . $this->_tables['users'] ."`");
        $result->execute();

        $fields = $result->fetchAll();

        $insert = array();

        $insert[array_shift($fields)['Field']] = Null;

        foreach ($fields as $field)
        {
            $fieldName = $field['Field'];
            $value = Null;

            switch ($fieldName)
            {
                case 'session':
                    $value = Null;
                    break;

                case 'time':
                    $value = time();
                    break;

                case 'password':
                    $value = $crypt->passwordHash(array_shift($values));
                    break;

                case 'status':
                    $value = ($this->_email['emailverify']) ? 0 : 1;
                    break;

                default:
                    $value = array_shift($values);
                    break;
            }

            $insert[$fieldName] = $value;
        }

        $result = $db->insert($this->_tables['users'], $insert, True);

        $accountId = $db->lastInsertId();

        if ($this->_email['emailverify'])
        {
            $this->sendVerificationEmail($accountId, $verifyEmail);
        }

    }

    public function login($username, $password, $remember = False)
    {

        $db    = Application::Instance()->database();
        $crypt = Application::Instance()->cryptography();

        $fields = array();

        foreach ($this->_login['dbcolumns'] as $key)

            $fields[$key] = $username;

        $result = $db->select($this->_tables['users'], '*', $db->where($db->dbOr($fields)));

        if (count($result) > 0)
        {
            if ($crypt->passwordVerify($password, $result[0][$this->_columns['password']]))
            {
                $cookie = Application::Instance()->cookie();
                $session = $crypt->randomHash();

                $db->update($this->_tables['users'], [$this->_columns['session'] => $session], $db->where(['id' => $result[0]['id']]));

                $cookie->set($this->_login['cookie'], $session, (($remember) ? time() + intval($this->_login['remember']) : 0));

                return True;
            }
        }

        return False;
    }

    public function logout()
    {
        if ($this->isLoggedIn())
        {
            $db = Application::Instance()->database();

            $session = $this->currentSession();

            $db->update($this->_tables['users'], [$this->_columns['session'] => Null], $db->where([$this->_columns['session'] => $session]));

            Application::Instance()->cookie()->remove($this->_login['cookie']);
        }
    }
}

$__model = new User;
