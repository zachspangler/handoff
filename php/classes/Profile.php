<?php
namespace Edu\Cnm\Handoff;
require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;

/**
 * Handoff User Profile
 *
 * This is the user profile information stored for a Handoff user.
 *
 * @author Zach Spangler <zaspangler@gmail.com> and Dylan McDonald <dmcdonald21@cnm.edu>
 * @version 1.0.0
 **/
class Profile implements \JsonSerializable {
	use ValidateUuid;
	use ValidateDate;
	/**
	 * id for this Profile; this is the primary key
	 * @var Uuid $profileId
	 **/
	private $profileId;
	/**
	 * id used to associate this profile with the correct company; this is the foreign key
	 * @var Uuid $profileCompanyId
	 **/
	private $profileCompanyId;
	/**
	 * Role associated with this Profile
	 * @var Uuid $profileSalesRoleId
	 **/
	private $profileSalesRoleId;
	/**
	 * profile is active and billed
	 * @var bool $profileActive
	 **/

	private $profileActive;
	/**
	 * /**
	 * token handed out to verify that the profile is valid and not malicious.
	 * @var string $profileActivationToken
	 **/
	private $profileActivationToken;
	/**
	 * email for this Profile; this is a unique index
	 * @var string $profileEmail
	 **/
	private $profileEmail;
	/**
	 * hash for profile password
	 * @var string $profileHash
	 **/
	private $profileHash;
	/**
	 * image associated with the Profile, only one image is allowed
	 * @var string $profileImage
	 **/
	private $profileImage;
	/**
	 * last login for the profile
	 * @var \DateTime $profileLastLogin
	 **/
	private $profileLastLogin;
	/**
	 * Name associated with this Profile; this is an index
	 * @var string $profileName
	 **/
	private $profileName;
	/**
	 * salt for profile password
	 * @var string $profileSalt
	 */
	private $profileSalt;
	/**
	 * salesforce id for the this Profile
	 * @var string $profileSalesForceId
	 **/
	private $profileSalesForceId;

	/**
	 * constructor for this Profile
	 *
	 * @param Uuid|string $newProfileId id of this Profile or null if a new Profile
	 * @param Uuid|string $newProfileCompanyId id of this company
	 * @param Uuid|string $newProfileSalesRoleId string description of the user role
	 * @param bool $newProfileActive identifies actives accounts
	 * @param string $newProfileActivationToken activation token to safe guard against malicious accounts
	 * @param string $newProfileEmail string containing email
	 * @param string $newProfileHash string containing password hash
	 * @param string $newProfileImage string containing the location of the image
	 * @param ?\DateTime $newProfileLastLogin documents the last time the account was used
	 * @param string $newProfileName string full name of the user
	 * @param string $newProfileSalt string containing password salt
	 * @param ?string $profileSalesForceId string to associate SalesForceId
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if a data type violates a data hint
	 * @throws \Exception if some other exception occurs
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 **/
	public function __construct($newProfileId, $newProfileCompanyId, $newProfileSalesRoleId, bool $newProfileActive, ?string $newProfileActivationToken, string $newProfileEmail, string $newProfileHash, string $newProfileImage, ?\DateTime $newProfileLastLogin, string $newProfileName, string $newProfileSalt, ?string $newProfileSalesForceId) {
		try {
			$this->setProfileId($newProfileId);
			$this->setProfileCompanyId($newProfileCompanyId);
			$this->setProfileSalesRoleId($newProfileSalesRoleId);
			$this->setProfileActive($newProfileActive);
			$this->setProfileActivationToken($newProfileActivationToken);
			$this->setProfileEmail($newProfileEmail);
			$this->setProfileHash($newProfileHash);
			$this->setProfileImage($newProfileImage);
			$this->setProfileLastLogin($newProfileLastLogin);
			$this->setProfileName($newProfileName);
			$this->setProfileSalt($newProfileSalt);
			$this->setProfileSalesForceId($newProfileSalesForceId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			//determine what exception type was thrown
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for profile id
	 *
	 * @return Uuid value of profile id (or null if new Profile)
	 **/
	public function getProfileId(): Uuid {
		return ($this->profileId);
	}
	/**
	 * mutator method for profile id
	 *
	 * @param  Uuid| string $newProfileId value of new profile id
	 * @throws \RangeException if $newProfileId is not positive
	 * @throws \TypeError if the profile Id is not
	 **/
	public function setProfileId($newProfileId): void {
		try {
			$uuid = self::validateUuid($newProfileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the profile id
		$this->profileId = $uuid;
	}

	/**
	 * accessor method for company id
	 *
	 * @return Uuid value of company id
	 **/
	public function getProfileCompanyId(): Uuid {
		return ($this->profileCompanyId);
	}
	/**
	 * mutator method for company id
	 *
	 * @param  Uuid| string $newProfileCompanyId value of new profile id
	 * @throws \RangeException if $newProfileCompanyId is not positive
	 * @throws \TypeError if the CompanyId is not
	 **/
	public function setProfileCompanyId($newProfileCompanyId): void {
		try {
			$uuid = self::validateUuid($newProfileCompanyId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the profile id
		$this->profileCompanyId = $uuid;
	}

	/**
	 * accessor method for SalesRole id
	 *
	 * @return Uuid value of SalesRole id
	 **/
	public function getProfileSalesRoleId(): Uuid {
		return ($this->profileSalesRoleId);
	}
	/**
	 * mutator method for SalesRole id
	 *
	 * @param  Uuid| string $newProfileSalesRoleId value of new SalesRole id
	 * @throws \RangeException if $newProfileSalesRoleId is not positive
	 * @throws \TypeError if the SalesRole id is not
	 **/
	public function setProfileSalesRoleId($newProfileSalesRoleId): void {
		try {
			$uuid = self::validateUuid($newProfileSalesRoleId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the profile id
		$this->profileSalesRoleId = $uuid;
	}
	/**
	 * accessor method for profile Active
	 *
	 * @return bool value of profile Active this shows how many active users the company currently has
	 **/
	public function getProfileActive() : bool {
		return ($this->profileActive);
	}
	/**
	 * mutator method for profile Active
	 *
	 * @param bool $newProfileActive
	 **/
	public function setProfileActive(bool $newProfileActive): void {
		$this->profileActive = $newProfileActive;
	}
	/**
	 * accessor method for account activation token
	 *
	 * @return string value of the activation token
	 */
	public function getProfileActivationToken(): ?string {
		return ($this->profileActivationToken);
	}
	/**
	 * mutator method for account activation token
	 *
	 * @param string $newProfileActivationToken
	 * @throws \InvalidArgumentException  if the token is not a string or insecure
	 * @throws \RangeException if the token is not exactly 32 characters
	 * @throws \TypeError if the activation token is not a string
	 */
	public function setProfileActivationToken(?string $newProfileActivationToken): void {
		if($newProfileActivationToken === null) {
			$this->profileActivationToken = null;
			return;
		}
		$newProfileActivationToken = strtolower(trim($newProfileActivationToken));
		if(ctype_xdigit($newProfileActivationToken) === false) {
			throw(new\RangeException("user activation is not valid"));
		}
		//make sure user activation token is only 32 characters
		if(strlen($newProfileActivationToken) !== 32) {
			throw(new\RangeException("user activation token has to be 32"));
		}
		$this->profileActivationToken = $newProfileActivationToken;
	}
	/**
	 * accessor method for email
	 *
	 * @return string value of email
	 **/
	public function getProfileEmail(): string {
		return $this->profileEmail;
	}
	/**
	 * mutator method for email
	 *
	 * @param string $newProfileEmail new value of email
	 * @throws \InvalidArgumentException if $newEmail is not a valid email or insecure
	 * @throws \RangeException if $newEmail is > 128 characters
	 * @throws \TypeError if $newEmail is not a string
	 **/
	public function setProfileEmail(string $newProfileEmail): void {
		// verify the email is secure
		$newProfileEmail = trim($newProfileEmail);
		$newProfileEmail = filter_var($newProfileEmail, FILTER_SANITIZE_EMAIL);
		if(empty($newProfileEmail) === true) {
			throw(new \InvalidArgumentException("profile email is empty or insecure"));
		}
		// verify the email will fit in the database
		if(strlen($newProfileEmail) > 128) {
			throw(new \RangeException("profile email is too large"));
		}
		// store the email
		$this->profileEmail = $newProfileEmail;
	}
	/**
	 * accessor method for profileHash
	 *
	 * @return string value of hash
	 */
	public function getProfileHash(): string {
		return $this->profileHash;
	}
	/**
	 * mutator method for profile hash password
	 *
	 * @param string $newProfileHash
	 * @throws \InvalidArgumentException if the hash is not secure
	 * @throws \RangeException if the hash is not 128 characters
	 * @throws \TypeError if profile hash is not a string
	 */
	public function setProfileHash(string $newProfileHash): void {
		//enforce that the hash is properly formatted
		$newProfileHash = trim($newProfileHash);
		$newProfileHash = strtolower($newProfileHash);
		if(empty($newProfileHash) === true) {
			throw(new \InvalidArgumentException("profile password hash empty or insecure"));
		}
		//enforce that the hash is a string representation of a hexadecimal
		if(!ctype_xdigit($newProfileHash)) {
			throw(new \InvalidArgumentException("profile password hash is empty or insecure"));
		}
		//enforce that the hash is exactly 128 characters.
		if(strlen($newProfileHash) !== 128) {
			throw(new \RangeException("profile hash must be 128 characters"));
		}
		//store the hash
		$this->profileHash = $newProfileHash;
	}
	/**
	 * accessor method for profile image
	 *
	 * @return string value of at profile image
	 **/
	public function getProfileImage(): string {
		return ($this->profileImage);
	}
	/**
	 * mutator method for profile image
	 *
	 * @param string $newProfileImage new value of profile image
	 * @throws \InvalidArgumentException if $newProfileImage is not a string or insecure
	 * @throws \RangeException if $newProfileImage is > 255 characters
	 * @throws \TypeError if $newProfileImage is not a string
	 **/
	public function setProfileImage(string $newProfileImage): void {
		// verify the profile image is secure
		$newProfileImage = trim($newProfileImage);
		$newProfileImage = filter_var($newProfileImage, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newProfileImage) === true) {
			throw(new \InvalidArgumentException("profile image is empty or insecure"));
		}
		// verify the profile image will fit in the database
		if(strlen($newProfileImage) > 255) {
			throw(new \RangeException("profile image is too large"));
		}
		// store the profile image
		$this->profileImage = $newProfileImage;
	}
	/**
	 * accessor method for last login date
	 *
	 * @return \DateTime value of at last login
	 **/
	public function getProfileLastLogin(): ?string {
		return ($this->profileLastLogin);
	}

	/**
	 * mutator method for last login date
	 *
	 * @param \DateTime|string $newProfileLastLogin for last login date
	 * @throws \InvalidArgumentException if $newProfileLastLogin is not a valid object or string
	 * @throws \RangeException if $newProfileLastLogin is a date that does not exist
	 **/
	public function setProfileLastLogin($newProfileLastLogin = null) : void {
		// base case: if the date is null, use the current date and time
		if($newProfileLastLogin === null) {
			$this->profileLastLogin = new \DateTime();
			return;
		}
		// store the like date using the ValidateDate trait
		try {
			$newProfileLastLogin = self::validateDateTime($newProfileLastLogin);
		} catch(\InvalidArgumentException | \RangeException $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->profileLastLogin = $newProfileLastLogin;
	}

	/**
	 * accessor method for profile name
	 *
	 * @return string value of at profile name
	 **/
	public function getProfileName(): string {
		return ($this->profileName);
	}
	/**
	 * mutator method for profile name
	 *
	 * @param string $newProfileName new value of profile  name
	 * @throws \InvalidArgumentException if $newProfileName is not a string or insecure
	 * @throws \RangeException if $newProfileName is > 64 characters
	 * @throws \TypeError if $newProfileName is not a string
	 **/
	public function setProfileName(string $newProfileName): void {
		// verify the profile first name is secure
		$newProfileName = trim($newProfileName);
		$newProfileName = filter_var($newProfileName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newProfileName) === true) {
			throw(new \InvalidArgumentException("profile  name is empty or insecure"));
		}
		// verify the profile  name will fit in the database
		if(strlen($newProfileName) > 64) {
			throw(new \RangeException("profile  name is too large"));
		}
		// store the profile first name
		$this->profileName = $newProfileName;
	}
	/**
	 *accessor method for profile salt
	 *
	 * @return string representation of the salt hexadecimal
	 */
	public function getProfileSalt(): string {
		return $this->profileSalt;
	}
	/**
	 * mutator method for profile salt
	 *
	 * @param string $newProfileSalt
	 * @throws \InvalidArgumentException if the salt is not secure
	 * @throws \RangeException if the salt is not 64 characters
	 * @throws \TypeError if the profile salt is not a string
	 */
	public function setProfileSalt(string $newProfileSalt): void {
		//enforce that the salt is properly formatted
		$newProfileSalt = trim($newProfileSalt);
		$newProfileSalt = strtolower($newProfileSalt);
		//enforce that the salt is a string representation of a hexadecimal
		if(!ctype_xdigit($newProfileSalt)) {
			throw(new \InvalidArgumentException("profile password hash is empty or insecure"));
		}
		//enforce that the salt is exactly 64 characters.
		if(strlen($newProfileSalt) !== 64) {
			throw(new \RangeException("profile salt must be 128 characters"));
		}
		//store the hash
		$this->profileSalt = $newProfileSalt;
	}
	/**
	 * accessor method for SalesForce id associated with profile
	 *
	 * @return string value of SalesForce id
	 **/
	public function getProfileSalesForceId(): ?string {
		return $this->profileSalesForceId;
	}
	/**
	 * mutator method for SalesForce id
	 *
	 * @param string $newProfileSalesForceId new value of email

	 * @throws \RangeException if $newProfileSalesForceId is > 255 characters
	 * @throws \TypeError if $newProfileSalesForceId is not a string
	 **/
	public function setProfileSalesForceId(string $newProfileSalesForceId): void {
		if($newProfileSalesForceId === null) {
			$this->ProfileSalesForceId = null;
			return;
		}

		// verify the SalesForce Id is secure
		$newProfileSalesForceId = trim($newProfileSalesForceId);
		$newProfileSalesForceId = filter_var($newProfileSalesForceId, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		// verify the SalesForce Id will fit in the database
		if(strlen($newProfileSalesForceId) > 255) {
			throw(new \RangeException("Salesforce id is too large"));
		}
		// store the email
		$this->profileSalesForceId = $newProfileSalesForceId;
	}
	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public
	function jsonSerialize() {
		$fields = get_object_vars($this);
		$fields["profileId"] = $this->profileId->toString();
		$fields["profileCompanyId"] = $this->profileCompanyId->toString();
		$fields["profileSalesRoleId"] = $this->profileSalesRoleId->toString();
		unset($fields["profileHash"]);
		unset($fields["profileSalt"]);
		return ($fields);
	}
}