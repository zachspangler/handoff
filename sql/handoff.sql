DROP TABLE IF EXISTS handoff;
DROP TABLE IF EXISTS lead;
DROP TABLE IF EXISTS leadSource;
DROP TABLE IF EXISTS profile;
DROP TABLE IF EXISTS salesRole;
DROP TABLE IF EXISTS company;

CREATE TABLE company (
	companyId BINARY(16) NOT NULL,
	companyCountry VARCHAR(128) NOT NULL,
	companyEmail VARCHAR(128) NOT NULL,
	companyName VARCHAR(128) NOT NULL,
	companyPhone VARCHAR(32),
	companyPostalCode VARCHAR(32) NOT NULL,
	companySalesforceOrgId VARCHAR(255),
	companyState VARCHAR(10) NOT NULL,
	UNIQUE (companyEmail),
	PRIMARY KEY (companyId)
);

CREATE TABLE salesRole (
	salesRoleId BINARY(16) NOT NULL,
	leadSourceCompanyId BINARY(16) NOT NULL,
	salesRoleName VARCHAR(64) NOT NULL,
	salesRoleType VARCHAR(64) NOT NULL,
	-- this officiates the primary key for the entity
	FOREIGN KEY (leadSourceCompanyId) REFERENCES company(companyId),
	PRIMARY KEY (salesRoleId)
);

CREATE TABLE profile (
	profileId BINARY(16) NOT NULL,
	profileCompanyId BINARY(16) NOT NULL,
	profileSalesRoleType BINARY(16) NOT NULL,
	profileActive TINYINT NOT NULL,
	profileActivationToken CHAR(32),
	profileEmail VARCHAR(128) NOT NULL,
	profileHash CHAR(128) NOT NULL,
	profileImage VARCHAR(255),
	profileLastLogin DATETIME(6),
	profileName VARCHAR(64) NOT NULL,
	profileSalt CHAR(64) NOT NULL,
	profileSalesforceId VARCHAR(32) NOT NULL,
	UNIQUE (profileEmail),
	UNIQUE (profileSalesforceId),
	INDEX (profileName),
	INDEX (profileEmail),
	-- this officiates the primary key for the entity
	FOREIGN KEY (profileCompanyId) REFERENCES company(companyId),
	FOREIGN KEY (profileSalesRoleType) REFERENCES salesRole(salesRoleType),
	PRIMARY KEY (profileId)
);

CREATE TABLE leadSource (
	leadSourceId BINARY(16) NOT NULL,
	leadSourceCompanyId BINARY(16) NOT NULL,
	leadSourceName VARCHAR(64) NOT NULL,
	leadSourceType VARCHAR(64) NOT NULL,
	INDEX (leadSourceType),
	-- this officiates the primary key for the entity
	FOREIGN KEY (leadSourceCompanyId) REFERENCES company(companyId),
	PRIMARY KEY (leadSourceId)
);


CREATE TABLE lead (
	leadId BINARY(16) NOT NULL,
	leadCompanyId BINARY(16) NOT NULL,
	leadLeadSource BINARY(16) NOT NULL,
	leadContactEmail VARCHAR(128),
	leadContactName VARCHAR(64) NOT NULL,
	leadContactPhone VARCHAR(32),
	leadDateTime DATETIME(6) NOT NULL,
	leadName VARCHAR(128),
	leadSalesForceId VARCHAR(255),
	leadSoldAmount DECIMAL(9,2),
	leadStatus VARCHAR(64),
	INDEX (leadContactEmail),
	INDEX (leadContactName),
		-- this officiates the primary key for the entity
	FOREIGN KEY (leadCompanyId) REFERENCES company(companyId),
	FOREIGN KEY (leadLeadSource) REFERENCES leadSource(leadSourceId),
	PRIMARY KEY (leadId)
);

CREATE TABLE handoff (
	leadHandoffId BINARY(16) NOT NULL,
	leadHandoffLeadId BINARY(16) NOT NULL,
	leadHandoffGiverProfileId BINARY(16) NOT NULL,
	leadHandoffReceiverProfileId BINARY(16) NOT NULL,
	leadAction VARCHAR(64) NOT NULL,
	-- this officiates the primary key for the entity
	FOREIGN KEY (leadHandoffLeadId) REFERENCES lead(leadId),
	FOREIGN KEY (leadHandoffGiverProfileId) REFERENCES profile(profileId),
	FOREIGN KEY (leadHandoffReceiverProfileId) REFERENCES profile(profileId),
	PRIMARY KEY (leadHandoffId)
);
