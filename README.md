## Laravel API 範例

此案例使用 Laravel 實作一個提供成立訂單的 API，包含兩個端點：

- `POST /api/orders`：建立訂單。
- `GET /api/orders/{id}`：查詢訂單。

## 環境設定

使用 Docker 和 Docker Compose 進行環境搭建。

```bash
docker-compose up -d
```

# SOLID 原則與設計模式

## SOLID 原則

- **單一職責原則（SRP）**

  每個類別都有明確的職責，例如：

  - `OrderController`：處理 HTTP 請求。
  - `OrderRequest`：驗證請求參數。
  - `OrderResource`：格式化回應數據。
  - `OrderService`：處理訂單的業務邏輯。
  - **models**：與資料庫交互。

- **開放封閉原則（OCP）**

  系統對於擴展是開放的，對於修改是封閉的。新增幣別時，不需要修改現有的程式碼。

- **里氏替換原則（LSP）**

  幣別訂單模型繼承自基礎模型，可在需要基礎模型的地方使用子類別。

- **介面隔離原則（ISP）**

  各模組之間透過明確的介面進行交互，不依賴不需要的介面。


## 設計模式

- **工廠模式**
  `OrderService` 幣別動態對應 model。

- **服務層模式**
  `OrderService` 處理訂單的業務邏輯。

- **觀察者模式**

  使用事件和監聽器實現非同步處理。

- **多型關聯**

  使用 Laravel 多型關聯來達到主訂單與不同幣別訂單資料表關聯。