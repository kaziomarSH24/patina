# BlueDart APIGEE Integration Plan

## Overview
BlueDart has migrated from their legacy SOAP/XML API (`netconnect.bluedart.com`) to a modern REST JSON API via APIGEE (`apigateway.bluedart.com`). This document outlines the step-by-step implementation plan for Patina Marketplace.

## Current Progress
- ✅ **Credentials:** Received active `ClientID` and `clientSecret`.
- ✅ **Authentication:** Verified 200 OK response from APIGEE Token endpoint.
- ✅ **Step 1: JWT Caching:** Implemented `authenticate()` in `BlueDartService.php` to fetch and cache the `JWTToken` for 50 minutes.

## Pending Steps (Next Actions)

### Step 2: Serviceability Check (Location Finder)
- **Goal:** Verify if BlueDart can deliver from the Seller`s pincode to the Buyer`s pincode before order placement.
- **Action:** Read the provided BlueDart PDF documentation to extract the exact REST endpoint and JSON payload structure.
- **Implementation:** Update `checkServiceability()` in `BlueDartService.php`.

### Step 3: Waybill (AWB) Generation
- **Goal:** Automatically generate a shipping label and tracking ID (AWB) when a seller accepts an Escrow order.
- **Action:** Extract the JSON schema for `/in/transportation/waybill/v1/GenerateWaybill` (or similar) from the PDF docs.
- **Implementation:** Update `generateAWB()` in `BlueDartService.php` to pass buyer/seller details and parse the returned AWB Number and PDF label.

### Step 4: Tracking & Status Sync (Cron Job)
- **Goal:** Track the live status of the parcel to release Escrow payments upon "Delivered" status.
- **Implementation:** Set up a background command (`php artisan schedule:run`) to hit the tracking API every few hours and update the `shipments` table.

## Notes
- Do not use the old XML format.
- Always pass the cached JWT token in the `Authorization: Bearer <token>` and `JWTToken: <token>` headers.
- Test endpoints first with `https://apigateway-sandbox.bluedart.com` before moving to Production.

