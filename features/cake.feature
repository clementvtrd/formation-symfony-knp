Feature: Add a cake
    In order to add a cake
    As an authenticated user
    I should be able to add a cake

    Background:
        Given these are users:
        | email | password |
        | john.doe@knplabs.com | 123456 |
    
    Scenario: Signing in
        Given I am not logged in
        When I am on "/cakes"
        And I press "Sign in"
        Then I should be redirected on "/signin"

    Scenario: Add a cake
        Given I am logged in as "john.doe@knplabs.com"
        When I am on "/cakes/create"
        And I fill "name" with "brownie"
        And I fill "description" field with "A simple chocolate cake"
        And I fill "price" field with "40"
        And I press "Add cake"
        Then I should be redirected on "/cakes"
        And I should see "brownie"
        And I should see "40.00€"
        And I should see "Bravo !"
     