Feature: campaign basics
  In order to manage campaigns
  I need to be able to create a campaign

Background:
  Given I am logged in as administrator
  And I open the dashboard

  Scenario: Import a campaign
    Given I am on a import campaign page
    When I select xml file to import "test-campaign.lorem-ipsum.xml"
    And I upload file and import
    And I select the import of attachments
    And I submit the import form
    Then I see a successful import message
    And the campaign is imported in DB as draft
