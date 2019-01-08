# Sameday\Requests\SamedayGetStatusSyncRequest

This entity represents a request to get all status updated between two given UNIX timestamps (paginated).

## Constructor parameters

- `int $startTimestamp` specifies the starting UNIX timestamp for statuses to retrieve
- `int $endTimestamp` specifies the ending UNIX timestamp for statuses to retrieve

> Please note that the difference between starting and ending timestamps cannot be bigger than 7200 (2 hours). 

## Pagination

To specify pagination parameters use the following setters on this object:

- `setPage(int $page)` specified the page to retrieve
- `setCountPerPage(int $countPerPage)` specifies the number of elements to retrieve
