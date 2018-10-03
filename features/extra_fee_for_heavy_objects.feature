@managing_heavy_objects
Feature:  Extra fee for heavy objects
  In order to compensate the cost of heavy objects
  As an administrator
  I want to add additional fee to objects heavier than 10 kg.

  Background:
    Given the store operates on a single channel in the "United States" named "Web"
    And the store ships everywhere for free
    And the store allows paying with "Cash on Delivery"
    And the store has a product "Stone" priced at "$400.00"
    And the "Stone" product is heavy
    And there is a customer "obelix@gaule.fr" that placed an order "#00000001"
    And the customer bought a single "Stone"
    And the customer "Obélix Legaulois" addressed it to "350 5th Ave", "10118" "New York" in the "United States" with identical billing address
    And the customer chose "Free" shipping method with "Cash on Delivery" payment
    And I am logged in as an administrator

  @ui
  Scenario: Add a ten-dollar fee to heavy suit
    When I view the summary of the order "#00000001"
    Then the order's total should be "$410.00"
    And this order should have "$10.00" fee for heavy objects
