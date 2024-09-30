# PHP Game Server

### Environment
**・language**：PHP<br>
**・framework**：Larvel<br>
**・database**：MySQL<br>
**・container**：Docker<br>

### Directories
**・app**：ゲームサーバーのロジック<br>
　**Architecture**<br>
　**Entitie -> (Usecase -> RepositoriesInterface <- Repositories) -> Service -> Router**<br>

**・routes/api.php**：ゲームサーバーのAPI<br>

**・master**：外部のマスタファイルをサーバー内で使用するための変換ツールや抽象クラスが入っている<br>
