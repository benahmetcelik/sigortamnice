<!DOCTYPE html>
<html lang="{{ domainSettings('site_default_lang','tr') }}">

<head>
    <meta charset="utf-8">
    <title>{{ domainSettings('site_title','NiceYazılım') }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="{{ domainSettings('site_keywords','sigorta,yazılım,otomasyon') }}" name="keywords">
    <meta content="{{ domainSettings('site_description','NiceYazılım sigortacılık üzerine teknolojik ürünler geliştiren bir firmadır.') }}" name="description">

    <!-- Favicon -->
    <link href="{{ domainSettings('site_favicon','/uploads/favicon.png') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ themeAssets() }}lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ themeAssets('css/style.css')}}" rel="stylesheet">
</head>
