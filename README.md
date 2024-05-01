# API Documentation for `/api/transfer`

This route is used to handle money transfer requests between users.

## HTTP Method

`POST`

## Endpoint

`/api/transfer`

## Payload

Requests must include the following fields:

- `payer`: The ID of the user who is paying (integer, required, cannot be the same as `payee`).
- `payee`: The ID of the user who is receiving the payment (integer, required).
- `value`: The amount to be transferred (numeric, required, minimum value of 0.01).

Example JSON payload:

```json
{
  "payer": 1,
  "payee": 2,
  "value": 100.50
}

Success Response

    Code: 200 OK
        Content: {"message": "Transaction completed successfully."}

Error Responses

    Code: 403 Forbidden
        Content: {"message": "You are not authorized to complete this transaction."}
        Description: This error occurs if the payer does not have permission to perform transactions.

    Code: 404 Not Found
        Content: {"message": "Payer not found."}
        Description: This error is returned when the specified payer does not exist in the database.

    Code: 422 Unprocessable Entity
        Content: {"message": "Sellers are not allowed to perform this transaction."}
        Description: This occurs if the payer is a seller and is restricted from initiating transactions.

    Code: 422 Unprocessable Entity
        Content: {"message": "Insufficient balance to complete the transaction."}
        Description: This error indicates that the payer does not have enough balance to complete the transaction.

    Code: 500 Internal Server Error
        Content: {"message": "Something went wrong with the transfer."}
        Description: A generic error when an unexpected condition was encountered during the transaction.
