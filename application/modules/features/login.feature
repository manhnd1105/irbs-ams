# features/login.feature
Feature: login
  In order to log in to irbs
  As anybody
  I need to provide my credentials such as account name and password

Scenario: Account credentials are valid
  Given I have my account name "manhnd" and my password "123456"
  When I fill them into textboxes
  Then I should get "OK"

Scenario: Account credentials are invalid
  Given I have my account name "manhnd" and my password "12345678"
  When I fill them into textboxes
  Then I should get "Invalid information"