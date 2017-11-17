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
	/**
	 * id for this Profile; this is the primary key
	 * @var Uuid $profileId
	 **/
	private $profileId;
	/**
	 * id used to associate this profile with the correct company; this is the foreign key
	 * @var Uuid $profileId
	 **/
	private $profileCompanyId;
	/**
	 * profile is active and billed
	 * @var string $profileActive
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
	 * Role associated with this Profile
	 * @var string $profileRole
	 **/
	private $profileRole;
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
	 * @param string|Uuid $newProfileId id of this Profile or null if a new Profile
	 * @param string $newProfileActivationToken activation token to safe guard against malicious accounts
	 * @param string $newProfileEmail string containing email
	 * @param string $newProfileFirstName string first name of the user
	 * @param string $newProfileHash string containing password hash
	 * @param string $newProfileImage string containing the location of the image
	 * @param string $newProfileLastName string last name of the user
	 * @param string $newProfileSalt string containing password salt
	 * @param string $newProfileUserName string user name designated by the user
	 * @param string $newProfileName string which is the combination of first name and last name
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if a data type violates a data hint
	 * @throws \Exception if some other exception occurs
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 **/
	public function __construct($newProfileId, ?string $newProfileActivationToken, string $newProfileBio, string $newProfileEmail, string $newProfileFirstName, string $newProfileHash, string $newProfileImage, string $newProfileLastName, string $newProfileSalt, string $newProfileUserName) {
		try {
			$this->setProfileId($newProfileId);
			$this->setProfileActivationToken($newProfileActivationToken);
			$this->setProfileBio($newProfileBio);
			$this->setProfileEmail($newProfileEmail);
			$this->setProfileFirstName($newProfileFirstName);
			$this->setProfileHash($newProfileHash);
			$this->setProfileImage($newProfileImage);
			$this->setProfileLastName($newProfileLastName);
			$this->setProfileSalt($newProfileSalt);
			$this->setProfileUserName($newProfileUserName);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			//determine what exception type was thrown
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}



}