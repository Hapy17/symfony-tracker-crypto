# Tracker
## Choses à créer
### Entity
- Token :
    - name
    - createdAt
    - price
    - rank
    - maxSupply
    - circulatingSupply
    - blockchainType
    ---
- Transaction
    - occuredAt
    - ammount
    - fee
    - status
    - reciever: User
    - sender: User
    - token: Token
    ---
- User
    - name
    - birthAt
    - createdAt
    - email
    - password
    ---
- TokenUser
    - quantity
    - walletAddress
    - token: Token
    - user: User
    ---

