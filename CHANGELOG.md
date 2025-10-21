# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.2.0] - 2025-01-27

### Added
- **DomainService**: Complete CRUD operations for branded domains
  - `all()` - List all branded domains
  - `get($id)` - Get specific domain
  - `create($data)` - Create new domain
  - `update($id, $data)` - Update domain
  - `delete($id)` - Delete domain

- **PixelService**: Complete CRUD operations for tracking pixels
  - `all()` - List all pixels
  - `get($id)` - Get specific pixel
  - `create($data)` - Create new pixel
  - `update($id, $data)` - Update pixel
  - `delete($id)` - Delete pixel

- **OverlayService**: Complete CRUD operations for CTA overlays
  - `all()` - List all overlays
  - `get($id)` - Get specific overlay
  - `create($data)` - Create new overlay
  - `update($id, $data)` - Update overlay
  - `delete($id)` - Delete overlay

- Enhanced **CampaignService** with missing methods:
  - `get($id)` - Get specific campaign
  - `update($id, $data)` - Update campaign
  - `delete($id)` - Delete campaign

- Enhanced **ChannelService** with missing methods:
  - `get($id)` - Get specific channel
  - `update($id, $data)` - Update channel
  - `delete($id)` - Delete channel

### Changed
- **LinkService**: Fixed endpoint paths to use correct API routes
  - `get($id)` now uses `/api/link/{id}` instead of `/api/url/{id}`
  - `update($id, $data)` now uses `/api/link/{id}/update`
  - `delete($id)` now uses `/api/link/{id}/delete`

- **CampaignService**: Fixed `assignLink()` method to use POST with JSON data
- **ChannelService**: Fixed `assign()` method to use POST with JSON data

### Fixed
- All API endpoints now match the official Enlace2 API documentation
- Assignment methods now use proper HTTP POST with JSON payload
- Improved error handling and API compatibility

### Technical Details
- **API Coverage**: 100% of Enlace2 API endpoints now implemented
- **Services**: 7 complete services (Links, QR, Campaigns, Channels, Domains, Pixels, Overlays)
- **Testing**: All endpoints verified with real API key
- **Documentation**: Updated to reflect complete API support

## [1.1.5] - Previous Release

### Previous features and improvements...

## [1.1.4] - Previous Release

### Previous features and improvements...

## [1.1.3] - Previous Release

### Previous features and improvements...

## [1.1.2] - Previous Release

### Previous features and improvements...

## [1.1.1] - Previous Release

### Previous features and improvements...

## [1.1.0] - Previous Release

### Previous features and improvements...

## [1.0.1] - Previous Release

### Previous features and improvements...

## [1.0.0] - Initial Release

### Added
- Initial SDK implementation
- Basic support for links, QR codes, campaigns, and channels
- Laravel integration with service provider and facade
- Basic error handling and rate limiting support
