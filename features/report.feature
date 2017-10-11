Feature: Popular words report
  In order to analyse search performance
  As a marketing analyst
  I want to generate a popular words report on the popular words count on given text
  So that I can view which words are popular

  Scenario Outline:
    Given The target popular words text file could be fetched: "<url>"
    When I want to generate a report for top "<number>" popular words
    Then I should see "<total_row_count>" rows in the report csv file
    Examples:
    | url                                                                             | number  | total_row_count |
    | https://s3-eu-west-1.amazonaws.com/secretsales-dev-test/interview/flatland.txt  | 100     | 101             |
