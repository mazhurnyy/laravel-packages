{{-- Title, keywords, description --}}

<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="csrf-token" content="{{ csrf_token() }}" />

<title>{{ \SiteMeta::getMetaTitle() }}</title>
<meta name="description" content="{{ \SiteMeta::getMetaDescription() }}" />
<meta name="keywords" content="{{ \SiteMeta::getMetaKeywords() }}" />