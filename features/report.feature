Feature: Popular words report
  In order to analyse search performance
  As a marketing analyst
  I want to generate a popular words report on the popular words count on given text
  So that I can view which words are popular

  Scenario Outline:
    Given The transaction data can be read on merchant id: "<merchantId>"
    When I want to generate a report on merchant id: "<merchantId>"
    Then I should see transactions csv file generated with only merchant id: "<merchantId>"
    Examples:
    | merchantId |
    | 1          |
