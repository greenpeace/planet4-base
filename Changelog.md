# Changelog

This document tracks all notable changes to Planet 4 project, introduced on each release.

## 2.30.0 - 2020-04-29

### Features

- [PLANET-4163](https://jira.greenpeace.org/browse/PLANET-4163) - Include excerpt in mobile search results
- [PLANET-4797](https://jira.greenpeace.org/browse/PLANET-4797) - Remove Shortcode UI plugin
- [PLANET-4878](https://jira.greenpeace.org/browse/PLANET-4878) - Make Campaign data layer field mandatory for Campaign pages
- [PLANET-4913](https://jira.greenpeace.org/browse/PLANET-4913) - Spreadsheet block: Fix size and add scrolling
- [PLANET-4946](https://jira.greenpeace.org/browse/PLANET-4946) - Edit selection in Gallery Block
- [PLANET-4968](https://jira.greenpeace.org/browse/PLANET-4968) - Hide Scope dropdown from Analytics & Tracking fields

### Bug Fixes

- [PLANET-4335](https://jira.greenpeace.org/browse/PLANET-4335) - EN Form: Country field label appears twice on front-end
- [PLANET-4723](https://jira.greenpeace.org/browse/PLANET-4723) - Author bio block is missing "Read more" link when too long - broken for M screens
- [PLANET-4862](https://jira.greenpeace.org/browse/PLANET-4862) - Load more button doesn't work on some pages / devices
- [PLANET-4887](https://jira.greenpeace.org/browse/PLANET-4887) - Text that is #000000 should be #1A1A1A
- [PLANET-4919](https://jira.greenpeace.org/browse/PLANET-4919) - Ensure automatically selected options are correctly shown in the Preview when switching themes
- [PLANET-4920](https://jira.greenpeace.org/browse/PLANET-4920) - Evergreen Pages: Some Opengraph metadata are empty
- [PLANET-5018](https://jira.greenpeace.org/browse/PLANET-5018) - Spreadsheet block: missing from Campaigns

## 2.29 - 2020-04-22

### Features

- [PLANET-4855](https://jira.greenpeace.org/browse/PLANET-4855) - Pull "Global Project" values from Smartsheet to campaign dropdowns (dataLayer)
- [PLANET-4857](https://jira.greenpeace.org/browse/PLANET-4857) - Add a new parameter 'projectID' to the dataLayer
- [PLANET-4859](https://jira.greenpeace.org/browse/PLANET-4859) - Pull "Local Project" values from each NRO's Smartsheet table
- [PLANET-4924](https://jira.greenpeace.org/browse/PLANET-4924) - Re-enable the native buttons block

### Bug Fixes

- [PLANET-4705](https://jira.greenpeace.org/browse/PLANET-4705) - Header Carousel: icon to delete image is not shown
- [PLANET-4738](https://jira.greenpeace.org/browse/PLANET-4738) - Search ErrorException: Warning: Invalid argument supplied for foreach()
- [PLANET-4901](https://jira.greenpeace.org/browse/PLANET-4901) - Campaign Sidebar: Ensure fields with dependencies get the right defaults
- [PLANET-4927](https://jira.greenpeace.org/browse/PLANET-4927) - Page, Evergreen: Spacing issue when using background image
- [PLANET-4953](https://jira.greenpeace.org/browse/PLANET-4953) - Uncaught TypeError: Return value of P4_User::name() must be of the type string
- [PLANET-4975](https://jira.greenpeace.org/browse/PLANET-4975) - Non-pdf attachments are returned by search
- [PLANET-4990](https://jira.greenpeace.org/browse/PLANET-4990) - Error upon logging in via Google

## 2.28 - 2020-04-15

### Features

- [PLANET-4864](https://jira.greenpeace.org/browse/PLANET-4864) - Remove pre-defined background color from Campaign themes
- [PLANET-4827](https://jira.greenpeace.org/browse/PLANET-4827) - Create importer for archive files into elasticsearch and include in search results


### Bug Fixes

- [PLANET-4895](https://jira.greenpeace.org/browse/PLANET-4895) - ErrorException: Warning: array_merge(): Argument #2 is not an array

## 2.27 - 2020-04-08

### Features

- [PLANET-4858](https://jira.greenpeace.org/browse/PLANET-4858) - Add a new parameter 'gPlatform' to the dataLayer
- [PLANET-4906](https://jira.greenpeace.org/browse/PLANET-4906) - Create UI for Whatsapp share button

### Bug Fixes

- [PLANET-4779](https://jira.greenpeace.org/browse/PLANET-4779) - Author bio: Not visible on Post
- [PLANET-4846](https://jira.greenpeace.org/browse/PLANET-4846) - EN Form: Bottom vertical space is off
- [PLANET-4820](https://jira.greenpeace.org/browse/PLANET-4820) P4CG: Footer color should not be applied when "Main website navigation" is selected

## 2.26.0 - 2020-03-26

### Features

[PLANET-4889](https://jira.greenpeace.org/browse/PLANET-4889) - Add new value to campaign dataLayer dropdown (Covid-19)

### Bug Fixes

[PLANET-4623](https://jira.greenpeace.org/browse/PLANET-4623) - Some code included in the Social Media Share excerpt
[PLANET-4822](https://jira.greenpeace.org/browse/PLANET-4822) - Gallery block: image selector not visible

## 2.25 - 2020-03-25

### Features

- [PLANET-4561](https://jira.greenpeace.org/browse/PLANET-4561) - Spreadsheet block: Follow Campaign styles
- [PLANET-4710](https://jira.greenpeace.org/browse/PLANET-4710) - Campaigns: Align CTA buttons in Columns block
- [PLANET-4833](https://jira.greenpeace.org/browse/PLANET-4833) - Campaigns: Add language selector to minimal navigation
- [PLANET-4838](https://jira.greenpeace.org/browse/PLANET-4838) - Campaigns: Apply main site WPML configuration
- [PLANET-4869](https://jira.greenpeace.org/browse/PLANET-4869) - Update login page UI for the new version of Google Login plugin

### Bug Fixes

- [PLANET-4806](https://jira.greenpeace.org/browse/PLANET-4806) - Covers block: Manual Override not finding posts
- [PLANET-4844](https://jira.greenpeace.org/browse/PLANET-4844) - Pages: Open Graph/Social fields not pulled
- [PLANET-4845](https://jira.greenpeace.org/browse/PLANET-4845) - JS Error: Unable to edit background image in pages
- [PLANET-4880](https://jira.greenpeace.org/browse/PLANET-4880) - Increase timeout value of the Optimize anti-flicker snippet

## 2.24 - 2020-03-18

### Bug Fixes

- [PLANET-4680](https://jira.greenpeace.org/browse/PLANET-4680) - Images: Font size on the caption is huge
- [PLANET-4842](https://jira.greenpeace.org/browse/PLANET-4842) - Carousel Header: scrolling not responsive on mobile
- [PLANET-4860](https://jira.greenpeace.org/browse/PLANET-4860) - ErrorException: Catchable Fatal Error: Object of class stdClass could not be converted to string

## 2.23.1 - 2020-03-12

### Bug Fixes

- [PLANET-4840](https://jira.greenpeace.org/browse/PLANET-4840) - Hide page title doesn't hide the title on Campaigs

## 2.23 - 2020-03-11

### Features

- [PLANET-4745](https://jira.greenpeace.org/browse/PLANET-4745) - Campaigns: EN form block title and CTA style
- [PLANET-4750](https://jira.greenpeace.org/browse/PLANET-4750) - P4CG: Adjust Header primary font options
- [PLANET-4751](https://jira.greenpeace.org/browse/PLANET-4751) - Refactor campaign exporter
- [PLANET-4767](https://jira.greenpeace.org/browse/PLANET-4767) - Spreadsheet block: Adjust vertical spacing

### Bug Fixes

- [PLANET-3427](https://jira.greenpeace.org/browse/PLANET-3427) - Preview mode: Not showing CPP templates and customized designs
- [PLANET-4766](https://jira.greenpeace.org/browse/PLANET-4766) - Align icons in social media share button
- [PLANET-4776](https://jira.greenpeace.org/browse/PLANET-4776) - P4CG: Arctic theme - CTA buttons are broken (Image style)
- [PLANET-4804](https://jira.greenpeace.org/browse/PLANET-4804) - Articles Block: Sorting order using Manual Override feature
- [PLANET-4821](https://jira.greenpeace.org/browse/PLANET-4821) - Gallery block: only first image is being displayed

## 2.22 - 2020-03-20

### Features

- [PLANET-4712](https://jira.greenpeace.org/browse/PLANET-4712) - Support multi page campaigns

### Bug Fixes

- [PLANET-4703](https://jira.greenpeace.org/browse/PLANET-4703) - Storytelling: Checkboxes displayed as bullet points
- [PLANET-4741](https://jira.greenpeace.org/browse/PLANET-4741) - Tags and Share buttons are visible when Title is hidden
- [PLANET-4775](https://jira.greenpeace.org/browse/PLANET-4775) - P4CG: Wrong green color on footer links
- [PLANET-4798](https://jira.greenpeace.org/browse/PLANET-4798) - MENA: Engaging Networks form thank you page text alignment
