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
    - ownQuantity
    - blockchainType
    ---
- Transaction
    - occuredAt
    - reciever: User
    - sender: User
    - ammount
    - fee
    - token: Token
    ---
- User
    - name
    - birthAt
    - createdAt
    - email
    - password
    - walletAddress
    ---
- userToken
    - token: Token
    - user: User
    - quantity
    ---

