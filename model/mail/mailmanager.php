<?php


class MailManager
{
    private $_charset;
    private $_config;
    private $_mode;

    public function __construct()
    {
        $config = Application::Instance()->configuration()['mail'];

        $this->_charset = $config['charset'];
        $this->_mode    = $config['mode'];
        $this->_config  = $config[$this->_mode];
    }

    public function create($subject, $message, $html = True)
    {
        $mail = new PHPMailer;

        $mail->CharSet = $this->_charset;

        if ($this->_mode == 'smtp')
        {
            $mail->isSMTP();

            $mail->Host       = $this->_config['host'];
            $mail->Port       = $this->_config['port'];
            $mail->SMTPAuth   = $this->_config['auth'];
            $mail->SMTPSecure = $this->_config['secure'];

            echo "Its smtp";

            if ($mail->SMTPAuth)
            {
                $mail->Username = $this->_config['username'];
                $mail->Password = $this->_config['password'];
            }
        }

        elseif ($this->_mode == 'sendmail')

            $mail->isSendmail();


        $mail->Subject = $subject;

        if ($html)

            $mail->msgHTML($message);

        else
        {
            $mail->Body    = $message;
            $mail->AltBody = $message;
        }

        return $mail;
    }
}
