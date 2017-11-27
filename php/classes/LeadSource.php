<?php

namespace Edu\Cnm\Handoff;
require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;

/**
 * Handoff Sales Role
 *
 * This is the lead source information stored for each company
 *
 * @author Zach Spangler <zaspangler@gmail.com> and Dylan McDonald <dmcdonald21@cnm.edu>
 * @version 1.0.0
 **/
class Profile implements \JsonSerializable {
	use ValidateUuid;
	/**
	 * id for this lead source identifier; this is the primary key
	 * @var Uuid $leadSourceId
	 **/
	private $leadSourceId;
	/**
	 * id used to associate this profile with the correct company; this is the foreign key
	 * @var Uuid $leadSourceCompanyId
	 **/
	private $leadSourceCompanyId;
	/**
	 * sales Role name which will be defined by the user
	 * @var string $leadSourceName
	 **/
	private $leadSourceName;
	/**
	 * sales Role type will be defined by our team and selected from a dropdown
	 * @var string $leadSourceType
	 **/
	private $leadSourceType;

	/**
	 * constructor for the Sales Role
	 *
	 * @param Uuid|string $newLeadSourceId id for this lead source identifier; this is the primary key
	 * @param Uuid|string $newLeadSourceCompanyId id of this company
	 * @param string $newLeadSourceName
	 * @param string $newLeadSourceType
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if a data type violates a data hint
	 * @throws \Exception if some other exception occurs
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 **/
	public function __construct($newLeadSourceId, $newLeadSourceCompanyId, string $newLeadSourceName, string $newLeadSourceType) {
		try {
			$this->setLeadSourceId($newLeadSourceId);
			$this->setLeadSourceCompanyId($newLeadSourceCompanyId);
			$this->setLeadSourceName($newLeadSourceName);
			$this->setLeadSourceType($newLeadSourceType);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			//determine what exception type was thrown
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for lead source id
	 *
	 * @return Uuid value of lead source id (or null if new Profile)
	 **/
	public function getLeadSourceId(): Uuid {
		return ($this->leadSourceId);
	}

	/**
	 * mutator method for lead source id
	 *
	 * @param  Uuid| string $newLeadSourceId value of new role id
	 * @throws \RangeException if $newLeadSourceId is not positive
	 * @throws \TypeError if the $newLeadSourceId is not
	 **/
	public function setLeadSourceId($newLeadSourceId): void {
		try {
			$uuid = self::validateUuid($newLeadSourceId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the profile id
		$this->leadSourceId = $uuid;
	}

	/**
	 * accessor method for lead source company id
	 *
	 * @return Uuid value of lead source company id (or null if new Profile)
	 **/
	public function getLeadSourceCompanyId(): Uuid {
		return ($this->leadSourceCompanyId);
	}

	/**
	 * mutator method for lead source company id
	 *
	 * @param  Uuid| string $newLeadSourceId value of new role id
	 * @throws \RangeException if $newLeadSourceCompanyId is not positive
	 * @throws \TypeError if the $newLeadSourceCompanyId is not
	 **/
	public function setLeadSourceCompanyId($newLeadSourceCompanyId): void {
		try {
			$uuid = self::validateUuid($newLeadSourceCompanyId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the profile id
		$this->leadSourceCompanyId = $uuid;
	}

	/**
	 * accessor method for leadSourceName
	 *
	 * @return string value of the leadSourceName
	 */
	public function getLeadSourceName(): string {
		return ($this->leadSourceName);
	}

	/**
	 * mutator method for leadSourceName
	 *
	 * @param string $newLeadSourceName
	 * @throws \InvalidArgumentException  if the input is not a string or insecure
	 * @throws \RangeException if the input is not exactly 64 characters
	 * @throws \TypeError if the input is not a string
	 */
	public function setLeadSourceName(string $newLeadSourceName): void {
		if($newLeadSourceName === null) {
			$this->leadSourceName = null;
			return;
		}
		$newLeadSourceName = strtolower(trim($newLeadSourceName));
		if(ctype_xdigit($newLeadSourceName) === false) {
			throw(new\RangeException("user activation is not valid"));
		}
		//make sure user activation token is only 64 characters
		if(strlen($newLeadSourceName) !== 64) {
			throw(new\RangeException("lead source name must be less than 64 characters"));
		}
		$this->leadSourceName = $newLeadSourceName;
	}

	/**
	 * accessor method for leadSourceType
	 *
	 * @return string value of the leadSourceType
	 */
	public function getLeadSourceType(): string {
		return ($this->leadSourceType);
	}

	/**
	 * mutator method for leadSourceType
	 *
	 * @param string $newLeadSourceType
	 * @throws \InvalidArgumentException  if the input is not a string or insecure
	 * @throws \RangeException if the input is not exactly 64 characters
	 * @throws \TypeError if the input is not a string
	 */
	public function setLeadSourceType(string $newLeadSourceType): void {
		if($newLeadSourceType === null) {
			$this->leadSourceType = null;
			return;
		}
		$newLeadSourceType = strtolower(trim($newLeadSourceType));
		if(ctype_xdigit($newLeadSourceType) === false) {
			throw(new\RangeException("user activation is not valid"));
		}
		//make sure user activation token is only 64 characters
		if(strlen($newLeadSourceType) !== 64) {
			throw(new\RangeException("lead source type must be less than 64 characters"));
		}
		$this->leadSourceType = $newLeadSourceType;
	}

	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		$fields["leadSourceId"] = $this->leadSourceId->toString();
		$fields["leadSourceCompanyId"] = $this->leadSourceCompanyId->toString();
		return ($fields);
	}
}