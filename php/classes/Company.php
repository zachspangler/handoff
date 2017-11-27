companyId BINARY(16) NOT NULL,
companyCountry VARCHAR(128) NOT NULL,
companyEmail VARCHAR(128) NOT NULL,
companyName VARCHAR(128) NOT NULL,
companyPhone VARCHAR(32),
companyPostalCode VARCHAR(32) NOT NULL,
companySalesforceOrgId VARCHAR(255),
companyState VARCHAR(10) NOT NULL,

<?php

namespace Edu\Cnm\Handoff;
require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;

/**
 * Handoff Action List
 *
 * This is the lead source information stored for each company
 *
 * @author Zach Spangler <zaspangler@gmail.com> and Dylan McDonald <dmcdonald21@cnm.edu>
 * @version 1.0.0
 **/
class Company implements \JsonSerializable {
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