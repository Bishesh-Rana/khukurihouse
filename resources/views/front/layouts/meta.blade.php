

<meta http-equiv="Content-Type" content="text/html">
<meta name="title" content="{{@$meta['title']}}">
<meta name="referrer" content="no-referrer-when-downgrade">
<meta name="robots" content="NDEX,FOLLOW">
<meta name="Googlebot" content="NDEX,FOLLOW" />
<meta name="csrf-token" content="{{ csrf_token() }}">

<meta name="description" content="{{@$meta['description']}}">
<meta name="keywords" content="{{@$meta['keywords']}}">
<meta name="geo.region" content="">
<meta name="geo.position" content="">
<meta name="ICBM" content="">
<meta name="geo.placename" content="{{  config('app.name') }}">


<!-- Dublin Core basic info -->
<meta name="dcterms.Format" content="text/html">
<meta name="dcterms.Language" content="{{ config('app.locale') }}">
<meta name="dcterms.Identifier" content="{{ url()->current() }}">
<meta name="dcterms.Relation" content="{{  config('app.name') }}">
<meta name="dcterms.Publisher" content="{{  config('app.name') }}">
<meta name="dcterms.Type" content="text/html">
<meta name="dcterms.Coverage" content="{{ url()->current() }}">
<meta name="dcterms.Title" content="{{@$meta['title']}}">
<meta name="dcterms.Subject" content="{{ !empty(@$meta['keywords'])? @$meta['keywords'] : config('meta.keywords') }}">
<meta name="dcterms.Contributor" content="{{config('app.name') }}">
<meta name="dcterms.Description" content="{{@$meta['description']}}">


<!-- Facebook OpenGraph -->
<meta property="og:locale" content="{{  config('app.locale') }}">
<meta property="og:type" content="{{ config('meta.type') }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="{{@$meta['title']}}">
<meta property="og:description" content="{{@$meta['description']}}">
<meta property="og:image" content="{{asset(@$meta['image'])}}">
<meta property="og:site_name" content="{{  config('app.name') }}">

<meta property="fb:app_id" content=""/>

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="">
<meta name="twitter:title" content="{{@$meta['title']}}">
<meta name="twitter:description" content="{{@$meta['description']}}">
<meta name="twitter:image" content="{{asset(@$meta['image'])}}">
