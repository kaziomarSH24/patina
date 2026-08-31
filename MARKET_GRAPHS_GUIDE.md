# Frontend Developer Guide: Market Graphs & Price Index

This document explains how to use the `Module D (Market)` API to render the Watch Price History charts and indicators on the mobile app.

---

## 📊 API Details

*   **Endpoint:** `GET /api/v1/market/price-history/{reference}`
*   **Authentication:** Public (No Bearer Token required)
*   **Purpose:** Provides time-series data for rendering 1M, 3M, 6M, and 1Y charts, along with market indicators like Momentum and 52-Week High/Low.

### Example Request
`GET /api/v1/market/price-history/116500LN`

### Example Response Structure
```json
{
  "ok": true,
  "message": "Market data retrieved successfully",
  "data": {
    "reference_number": "116500LN",
    "current_market_price": 14250.75,
    "indicators": {
      "52w_high": 15100.20,
      "52w_low": 11500.00,
      "momentum_1m_percentage": 3.45,
      "liquidity_score": 7.8,
      "volatility_index": "Medium"
    },
    "chart_data": {
      "1M": [
        { "date": "2026-07-31", "price": 13775.50 },
        { "date": "2026-08-01", "price": 13800.00 }
        // ... 30 data points
      ],
      "3M": [ /* 90 data points */ ],
      "6M": [ /* 180 data points */ ],
      "1Y": [ /* 365 data points */ ]
    }
  }
}
```

---

## 💡 UI Implementation Guide

### 1. Rendering the Chart (React Native / Next.js)
When the user selects the "1M" filter button on the UI, you should pass `data.chart_data["1M"]` to your Chart library (like `react-native-chart-kit` or `Chart.js`).

**X-Axis (Labels):** Map over the array and extract the `date`.
**Y-Axis (Data):** Map over the array and extract the `price`.

*Example in JS:*
```javascript
const graphData = response.data.chart_data['1M'];
const labels = graphData.map(item => item.date);
const prices = graphData.map(item => item.price);

// Pass labels and prices to the Chart component
```

### 2. Rendering Indicators
*   **Current Price:** Display `data.current_market_price` prominently.
*   **Momentum (Trend):** Use `data.indicators.momentum_1m_percentage`.
    *   If positive (e.g., `+3.45`), show a green `↑` arrow and color the text green.
    *   If negative (e.g., `-1.20`), show a red `↓` arrow and color the text red.
*   **52-Week Range:** Use `52w_low` and `52w_high` to show a progress bar or min-max slider indicating where the current price sits over the last year.
*   **Liquidity & Volatility:** Display as badges or tags (e.g., `Volatility: Medium`, `Liquidity: 7.8/10`).

---

**Note on Data:** 
Currently, the backend generates highly realistic *dummy* random-walk data because TheWatchAPI blocks historical pricing on their Free Tier. Once the Premium Tier is purchased, the backend `MarketService` will be updated to proxy real data, but the API response structure above will remain **exactly the same**. You do not need to change your frontend code later!
