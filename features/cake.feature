Feature: Add a cake
    In order to add a cake
    As an authenticated user
    I should be able to add a cake

    Scenario: Add a cake
     Given I am an authenticated user
      When I am on the creation page
      And I fill the name field
      And I fill the description field
      And I fill the price field
      And I press the button "Add cake"
      Then I should be redirected to the home page
      And I should see my cake
      And I should see the success message
     