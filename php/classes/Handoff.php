
leadHandoffId BINARY(16) NOT NULL,
	leadHandoffLeadId BINARY(16) NOT NULL,
	leadHandoffGiverProfileId BINARY(16) NOT NULL,
	leadHandoffReceiverProfileId BINARY(16) NOT NULL,
	leadAction VARCHAR(64) NOT NULL,

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
	 * @var Uuid $leadHandoffId
	 **/
	private $leadHandoffId;
	/**
	 * id used to associate this profile with the correct company; this is the foreign key
	 * @var Uuid $leadHandoffLeadId
	 **/
	private $leadHandoffLeadId;
	/**
	 * id used to associate this profile with the correct company; this is the foreign key
	 * @var Uuid $leadHandoffGiverProfileId
	 **/
	private $leadHandoffGiverProfileId;
	/**
	 * id used to associate this profile with the correct company; this is the foreign key
	 * @var Uuid $leadHandoffReceiverProfileI
	 **/
	private $leadHandoffReceiverProfileId;
	/**
	 * sales Role name which will be defined by the user
	 * @var string $leadSourceName
	 **/
	private $leadHandoffAction;

	/**
	 * constructor for the Sales Role
	 *
	 * @param Uuid|string $newLeadHandoffId id for this lead source identifier; this is the primary key
	 * @param Uuid|string $newLeadHandoffLeadId id of this company
	 * @param Uuid|string $leadHandoffGiverProfileId
	 * @param Uuid|string $leadHandoffReceiverProfileId
	 * @param string $leadHandoffAction
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if a data type violates a data hint
	 * @throws \Exception if some other exception occurs
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 **/
	public function __construct($newLeadHandoffId, $newLeadHandoffLeadId, $newLeadHandoffGiverProfileId, $newLeadHandoffReceiverProfileId, string $newLeadHandoffAction) {
		try {
			$this->setLeadHandoffId($newLeadHandoffId);
			$this->setLeadHandoffLeadId($newLeadHandoffLeadId);
			$this->setLeadHandoffGiverProfileId($newLeadHandoffGiverProfileId);
			$this->setLeadHandoffReceiverProfileId($newLeadHandoffReceiverProfileId);
			$this->setLeadHandoffAction($newLeadHandoffAction);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			//determine what exception type was thrown
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for lead handoff id
	 *
	 * @return Uuid value of  lead handoff id (or null if new Profile)
	 **/
	public function getLeadHandoffId(): Uuid {
		return ($this->leadHandoffId);
	}

	/**
	 * mutator method for  lead handoff id
	 *
	 * @param  Uuid| string $newLeadHandoffId value of new role id
	 * @throws \RangeException if $newLeadHandoffId is not positive
	 * @throws \TypeError if the $newLeadHandoffId is not
	 **/
	public function setLeadHandoffId($newLeadHandoffId): void {
		try {
			$uuid = self::validateUuid($newLeadHandoffId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the profile id
		$this->leadHandoffId = $uuid;
	}

	/**
	 * accessor method for LeadHandoffLeadId
	 *
	 * @return Uuid value of  LeadHandoffLeadId (or null if new Profile)
	 **/
	public function getLeadHandoffLeadId(): Uuid {
		return ($this->leadHandoffLeadId);
	}

	/**
	 * mutator method for  LeadHandoffLeadId
	 *
	 * @param  Uuid| string $newLeadHandoffId value of new role id
	 * @throws \RangeException if $newLeadHandoffId is not positive
	 * @throws \TypeError if the $newLeadHandoffId is not
	 **/
	public function setLeadHandoffLeadId($newLeadHandoffLeadId): void {
		try {
			$uuid = self::validateUuid($newLeadHandoffLeadId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the profile id
		$this->leadHandoffLeadId = $uuid;
	}

	/**
	 * accessor method for LeadHandoffGiverProfileId
	 *
	 * @return Uuid value of LeadHandoffGiverProfileId (or null if new Profile)
	 **/
	public function getLeadHandoffGiverProfileId(): Uuid {
		return ($this->leadHandoffGiverProfileId);
	}

	/**
	 * mutator method for LeadHandoffGiverProfileId
	 *
	 * @param  Uuid| string $newLeadHandoffGiverProfileId value of new role id
	 * @throws \RangeException if $newLeadHandoffGiverProfileId is not positive
	 * @throws \TypeError if the $newLeadHandoffGiverProfileId is not
	 **/
	public function setLeadHandoffGiverProfileId($newLeadHandoffGiverProfileId): void {
		try {
			$uuid = self::validateUuid($newLeadHandoffGiverProfileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the profile id
		$this->leadHandoffGiverProfileId = $uuid;
	}

	/**
	 * accessor method for LeadHandoffReceiverProfileId
	 *
	 * @return Uuid value of LeadHandoffReceiverProfileId (or null if new Profile)
	 **/
	public function getLeadHandoffReceiverProfileId(): Uuid {
		return ($this->leadHandoffReceiverProfileId);
	}

	/**
	 * mutator method for LeadHandoffReceiverProfileId
	 *
	 * @param  Uuid| string $newLeadHandoffReceiverProfileId value of new role id
	 * @throws \RangeException if $newLeadHandoffReceiverProfileId is not positive
	 * @throws \TypeError if the $newLeadHandoffReceiverProfileId is not
	 **/
	public function setLeadHandoffReceiverProfileId($newLeadHandoffReceiverProfileId): void {
		try {
			$uuid = self::validateUuid($newLeadHandoffReceiverProfileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the profile id
		$this->leadHandoffReceiverProfileId = $uuid;
	}
	/**
	 * accessor method for leadSourceName
	 *
	 * @return string value of the leadSourceName
	 */
	public function getLeadHandoffAction(): string {
		return ($this->leadHandoffAction);
	}

	/**
	 * mutator method for leadSourceName
	 *
	 * @param string $newLeadSourceName
	 * @throws \InvalidArgumentException  if the input is not a string or insecure
	 * @throws \RangeException if the input is not exactly 64 characters
	 * @throws \TypeError if the input is not a string
	 */
	public function setLeadHandoffAction(string $newLeadHandoffAction): void {
		if($newLeadHandoffAction === null) {
			$this->leadHandoffAction = null;
			return;
		}
		$newLeadHandoffAction = strtolower(trim($newLeadHandoffAction));
		if(ctype_xdigit($newLeadHandoffAction) === false) {
			throw(new\RangeException("user activation is not valid"));
		}
		//make sure user activation token is only 64 characters
		if(strlen($newLeadHandoffAction) !== 64) {
			throw(new\RangeException("lead source name must be less than 64 characters"));
		}
		$this->leadHandoffAction = $newLeadHandoffAction;
	}
	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		$fields["leadHandoffId"] = $this->leadHandoffId->toString();
		$fields["leadHandoffLeadId"] = $this->leadHandoffLeadId->toString();
		$fields["leadHandoffGiverProfileId"] = $this->leadHandoffGiverProfileId->toString();
		$fields["leadHandoffReceiverProfileId"] = $this->leadHandoffReceiverProfileId->toString();
		return ($fields);
	}
}