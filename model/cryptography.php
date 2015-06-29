<?php

class Cryptography
{

	// Encryption/Decryption Algorithm Constants
	const AES_128_CBC           = 'AES-128-CBC';
	const AES_128_CBC_HMAC_SHA1 = 'AES-128-CBC-HMAC-SHA1';
	const AES_128_CFB           = 'AES-128-CFB';
	const AES_128_CFB1          = 'AES-128-CFB1';
	const AES_128_CFB8          = 'AES-128-CFB8';
	const AES_128_CTR           = 'AES-128-CTR';
	const AES_128_ECB           = 'AES-128-ECB';
	const AES_128_OFB           = 'AES-128-OFB';
	const AES_128_XTS           = 'AES-128-XTS';
	const AES_192_CBC           = 'AES-192-CBC';
	const AES_192_CFB           = 'AES-192-CFB';
	const AES_192_CFB1          = 'AES-192-CFB1';
	const AES_192_CFB8          = 'AES-192-CFB8';
	const AES_192_CTR           = 'AES-192-CTR';
	const AES_192_ECB           = 'AES-192-ECB';
	const AES_192_OFB           = 'AES-192-OFB';
	const AES_256_CBC           = 'AES-256-CBC';
	const AES_256_CBC_HMAC_SHA1 = 'AES-256-CBC-HMAC-SHA1';
	const AES_256_CFB           = 'AES-256-CFB';
	const AES_256_CFB1          = 'AES-256-CFB1';
	const AES_256_CFB8          = 'AES-256-CFB8';
	const AES_256_CTR           = 'AES-256-CTR';
	const AES_256_ECB           = 'AES-256-ECB';
	const AES_256_OFB           = 'AES-256-OFB';
	const AES_256_XTS           = 'AES-256-XTS';
	const BF_CBC                = 'BF-CBC';
	const BF_CFB                = 'BF-CFB';
	const BF_ECB                = 'BF-ECB';
	const BF_OFB                = 'BF-OFB';
	const CAMELLIA_128_CBC      = 'CAMELLIA-128-CBC';
	const CAMELLIA_128_CFB      = 'CAMELLIA-128-CFB';
	const CAMELLIA_128_CFB1     = 'CAMELLIA-128-CFB1';
	const CAMELLIA_128_CFB8     = 'CAMELLIA-128-CFB8';
	const CAMELLIA_128_ECB      = 'CAMELLIA-128-ECB';
	const CAMELLIA_128_OFB      = 'CAMELLIA-128-OFB';
	const CAMELLIA_192_CBC      = 'CAMELLIA-192-CBC';
	const CAMELLIA_192_CFB      = 'CAMELLIA-192-CFB';
	const CAMELLIA_192_CFB1     = 'CAMELLIA-192-CFB1';
	const CAMELLIA_192_CFB8     = 'CAMELLIA-192-CFB8';
	const CAMELLIA_192_ECB      = 'CAMELLIA-192-ECB';
	const CAMELLIA_192_OFB      = 'CAMELLIA-192-OFB';
	const CAMELLIA_256_CBC      = 'CAMELLIA-256-CBC';
	const CAMELLIA_256_CFB      = 'CAMELLIA-256-CFB';
	const CAMELLIA_256_CFB1     = 'CAMELLIA-256-CFB1';
	const CAMELLIA_256_CFB8     = 'CAMELLIA-256-CFB8';
	const CAMELLIA_256_ECB      = 'CAMELLIA-256-ECB';
	const CAMELLIA_256_OFB      = 'CAMELLIA-256-OFB';
	const CAST5_CBC             = 'CAST5-CBC';
	const CAST5_CFB             = 'CAST5-CFB';
	const CAST5_ECB             = 'CAST5-ECB';
	const CAST5_OFB             = 'CAST5-OFB';
	const DES_CBC               = 'DES-CBC';
	const DES_CFB               = 'DES-CFB';
	const DES_CFB1              = 'DES-CFB1';
	const DES_CFB8              = 'DES-CFB8';
	const DES_ECB               = 'DES-ECB';
	const DES_EDE               = 'DES-EDE';
	const DES_EDE_CBC           = 'DES-EDE-CBC';
	const DES_EDE_CFB           = 'DES-EDE-CFB';
	const DES_EDE_OFB           = 'DES-EDE-OFB';
	const DES_EDE3              = 'DES-EDE3';
	const DES_EDE3_CBC          = 'DES-EDE3-CBC';
	const DES_EDE3_CFB          = 'DES-EDE3-CFB';
	const DES_EDE3_CFB1         = 'DES-EDE3-CFB1';
	const DES_EDE3_CFB8         = 'DES-EDE3-CFB8';
	const DES_EDE3_OFB          = 'DES-EDE3-OFB';
	const DES_OFB               = 'DES-OFB';
	const DESX_CBC              = 'DESX-CBC';
	const IDEA_CBC              = 'IDEA-CBC';
	const IDEA_CFB              = 'IDEA-CFB';
	const IDEA_ECB              = 'IDEA-ECB';
	const IDEA_OFB              = 'IDEA-OFB';
	const RC2_40_CBC            = 'RC2-40-CBC';
	const RC2_64_CBC            = 'RC2-64-CBC';
	const RC2_CBC               = 'RC2-CBC';
	const RC2_CFB               = 'RC2-CFB';
	const RC2_ECB               = 'RC2-ECB';
	const RC2_OFB               = 'RC2-OFB';
	const RC4                   = 'RC4';
	const RC4_40                = 'RC4-40';
	const RC4_HMAC_MD5          = 'RC4-HMAC-MD5';
	const SEED_CBC              = 'SEED-CBC';
	const SEED_CFB              = 'SEED-CFB';
	const SEED_ECB              = 'SEED-ECB';
	const SEED_OFB              = 'SEED-OFB';


	// Digest Algorithm Constants
	const DSA             = 'DSA';
	const DSA_SHA         = 'DSA-SHA';
	const MD4             = 'MD4';
	const MD5             = 'MD5';
	const MDC2            = 'MDC2';
	const RIPEMD160       = 'RIPEMD160';
	const SHA             = 'SHA';
	const SHA1            = 'SHA1';
	const SHA224          = 'SHA224';
	const SHA256          = 'SHA256';
	const SHA384          = 'SHA384';
	const SHA512          = 'SHA512';
	const DSA_ENCRYPTION  = 'dsaEncryption';
	const DSA_WITH_SHA    = 'dsaWithSHA';
	const ECDSA_WITH_SHA1 = 'ecdsa-with-SHA1';
	const WHIRLPOOL       = 'whirlpool';

	public function generateSalt($length = 32)
	{
		return openssl_random_pseudo_bytes($length);
	}

	public function randomHash($method = self::SHA256)
	{
		return $this->Hash($this->GenerateSalt(256), $method);
	}

	public function hash($data, $salt = '', $method = self::SHA256)
	{
		return openssl_digest($salt . $data, $method);
	}

	public function passwordHash($password, $algorithm = PASSWORD_BCRYPT, $options = array())
	{
		return password_hash($password, $algorithm, $options);
	}

	public function passwordVerify($password, $hash)
	{
		return password_verify($password, $hash);
	}

	public function generateFileName($ext = '', $length = 32)
	{
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_";
		$name = '';

		for ($i = 0; $i < $length; $i++)

			$name .= $chars[rand(0, strlen($chars) - 1)];

		return $name . ".$ext";
	}

	public function encrypt($data, $password, $method = self::AES_128_CBC, $options = Null, $iv = '0123456789abcdef')
	{
		return openssl_encrypt($data, $method, $password, $options, $iv);
	}

	public function decrypt($data, $password, $method = self::AES_128_CBC, $options = Null, $iv = '0123456789abcdef')
	{
		return openssl_decrypt($data, $method, $password, $options, $iv);
	}

}

$__model = new Cryptography();
