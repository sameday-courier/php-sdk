# Sameday\Requests\SamedayGetCountiesRequest

This entity represents a request to get list of available counties (paginated).

## Constructor parameters

- `string|null $awb` specifies a filter for county name

## Pagination

To specify pagination parameters use the following setters on this object:

- `setPage(int $page)` specified the page to retrieve
- `setCountPerPage(int $countPerPage)` specifies the number of elements to retrieve
