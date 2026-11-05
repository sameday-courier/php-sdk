# Sameday\Requests\SamedayGetAwbStatusSyncRequest

This entity represents a request to get AWB status transitions between two UNIX timestamps (paginated).

Endpoint: `GET /api/client/status-sync`

The maximum interval between the two timestamps is 2 hours.

## Constructor parameters

- `int $startTimestamp` start of the sync window (UNIX timestamp)
- `int $endTimestamp` end of the sync window (UNIX timestamp)

## Query parameters

- `startTimestamp` (required)
- `endTimestamp` (required)
- `page`
- `countPerPage`
