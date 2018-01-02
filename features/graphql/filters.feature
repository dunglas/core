Feature: Collections filtering
  In order to retrieve subsets of collections
  As an API consumer
  I need to be able to set filters

  @createSchema
  @dropSchema
  Scenario: Retrieve filters from the schema
    When I send the following GraphQL request:
    """
    {
      __type(name: "Query") {
        fields(name: "dummies") {
          name
        }
      }
    }
    """
    Then print last JSON response
