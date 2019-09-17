# Sameday\Requests\SamedayGetCitiesRequest

This entity represents a request to get list of available cities (paginated).

## Constructor parameters

- `int|null $countyId` specifies a filter for county identifier
- `int|null $name` specifies a filter for city name
- `int|null $postalCode` specifies a filter for postal code

## Pagination

To specify pagination parameters use the following setters on this object:

- `setPage(int $page)` specified the page to retrieve
- `setCountPerPage(int $countPerPage)` specifies the number of elements to retrieve
