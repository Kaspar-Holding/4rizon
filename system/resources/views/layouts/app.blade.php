<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>4RIZON Dashboard</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- site icon -->
      <link rel="icon" href="{{ asset('new/images/fevicon.png')}}" type="image/png" />
      <!-- bootstrap css -->
      <link rel="stylesheet" href="{{ asset('new/css/bootstrap.min.css')}}" />
      <!-- site css -->
      <link rel="stylesheet" href="{{ asset('new/style.css')}}" />
      <!-- responsive css -->
      <link rel="stylesheet" href="{{ asset('new/css/responsive.css')}}" />
      <!-- color css -->
      <link rel="stylesheet" href="{{ asset('new/css/colors.css')}}" />
      <!-- select bootstrap -->
      <link rel="stylesheet" href="{{ asset('new/css/bootstrap-select.css')}}" />
      <!-- scrollbar css -->
      <link rel="stylesheet" href="{{ asset('new/css/perfect-scrollbar.css')}}" />
      <!-- custom css -->
      <link rel="stylesheet" href="{{ asset('new/css/custom.css')}}" />
      <link rel="stylesheet" href="{{ asset('new/css/select2.min.css')}}" />
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
      <link rel="stylesheet" href=" https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/a549aa8780dbda16f6cff545aeabc3d71073911e/src/js/bootstrap-datetimepicker.js" type="text/css" media="all">
      <link rel="stylesheet" href="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/a549aa8780dbda16f6cff545aeabc3d71073911e/build/css/bootstrap-datetimepicker.css">
   </head> 
   <style>
    .w-layout-grid {
  display: -ms-grid;
  display: grid;
  grid-auto-columns: 1fr;
  -ms-grid-columns: 1fr 1fr;
  grid-template-columns: 1fr 1fr;
  -ms-grid-rows: auto auto;
  grid-template-rows: auto auto;
  grid-row-gap: 16px;
  grid-column-gap: 16px;
}

.hero-section {
  position: static;
  left: 0%;
  top: 0%;
  right: 0%;
  bottom: 0%;
  height: 100%;
  min-height: 76.783%;
  background-image: url('/images/Main.webp');
  background-position: 0% 0%;
  background-size: cover;
  background-repeat: repeat;
  opacity: 0.84;
  color: rgba(0, 0, 0, 0.65);
}

.brand {
  position: relative;
  left: 25%;
  text-align: justify;
}

.navbar {
  padding-top: 0px;
  padding-bottom: 0px;
  background-color: transparent;
}

.body {
  height: 100%;
  min-height: 100%;
  font-family: Mulish, sans-serif;
  color: #e5e5e5;
}

.nav-link {
  background-color: transparent;
  color: #fff;
}

.nav-link:hover {
  color: #2d9cdb;
}

.nav-link-2 {
  color: #fff;
}

.nav-link-3 {
  color: #fff;
}

.nav-menu {
  padding-top: 50px;
  padding-bottom: 0px;
}

.image {
  max-width: 100%;
}

.heading {
  color: rgb(211, 47, 47);
  text-align: center;
  letter-spacing: 0.3px;
}

.paragraph {
  color: #fff;
  font-size: 14px;
  line-height: 28.8px;
  text-align: center;
  letter-spacing: 0.5px;
}

.container {
  position: relative;
  top: 50px;
}

.div-block {
  position: relative;
  left: 0%;
  top: auto;
  right: 0%;
  bottom: -30%;
  padding-top: 30px;
  padding-bottom: 40px;
  background-color: transparent;
  background-image: url('/images/Background-1.png');
  background-position: 50% 50%;
  background-size: cover;
  background-repeat: repeat;
}

.about-section {
  background-color: #e5e5e5;
}

.div-block-2 {
  padding-top: 140px;
  padding-bottom: 60px;
  color: transparent;
}

.grid {
  -webkit-box-align: start;
  -webkit-align-items: start;
  -ms-flex-align: start;
  align-items: start;
  -webkit-align-content: start;
  -ms-flex-line-pack: start;
  align-content: start;
  grid-column-gap: 82px;
  -ms-grid-columns: 1fr 1fr;
  grid-template-columns: 1fr 1fr;
  -ms-grid-rows: auto;
  grid-template-rows: auto;
}

.heading-2 {
  color: #11142d;
  font-size: 22px;
  font-weight: 800;
  text-align: center;
}

.paragraph-2 {
  color: #515151;
  font-weight: 700;
  text-align: center;
}

.heading-3 {
  color: #11142d;
  font-size: 22px;
  line-height: 18px;
  font-weight: 800;
}

.paragraph-3 {
  margin-bottom: 10px;
  color: #515151;
  font-weight: 700;
}

.div-block-3 {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: horizontal;
  -webkit-box-direction: normal;
  -webkit-flex-direction: row;
  -ms-flex-direction: row;
  flex-direction: row;
  -webkit-box-pack: start;
  -webkit-justify-content: flex-start;
  -ms-flex-pack: start;
  justify-content: flex-start;
  -webkit-box-align: start;
  -webkit-align-items: flex-start;
  -ms-flex-align: start;
  align-items: flex-start;
}

.div-block-4 {
  display: block;
}

.div-block-5 {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  margin-left: 80px;
  -webkit-box-pack: justify;
  -webkit-justify-content: space-between;
  -ms-flex-pack: justify;
  justify-content: space-between;
}

.div-block-6 {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  padding-right: 80px;
  -webkit-box-pack: justify;
  -webkit-justify-content: space-between;
  -ms-flex-pack: justify;
  justify-content: space-between;
}

.heading-4 {
  color: #11142d;
  font-size: 22px;
  line-height: 18px;
  font-weight: 800;
}

.paragraph-4 {
  color: #515151;
  font-weight: 700;
}

.div-block-7 {
  margin-right: 115px;
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -webkit-align-items: center;
  -ms-flex-align: center;
  align-items: center;
}

.button {
  margin-top: 10px;
  padding: 14px 24px;
  border-radius: 8px;
  background-color: #2d9cdb;
  color: #fff;
  letter-spacing: 0.5px;
  text-transform: none;
}

.button:hover {
  color: #11142d;
}

.div-block-8 {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -webkit-align-items: center;
  -ms-flex-align: center;
  align-items: center;
}

.grid-2 {
  grid-column-gap: 92px;
  -ms-grid-columns: 1fr 1fr;
  grid-template-columns: 1fr 1fr;
  -ms-grid-rows: auto;
  grid-template-rows: auto;
}

.grid-3 {
  -ms-grid-rows: auto;
  grid-template-rows: auto;
}

.div-block-9 {
  margin-top: 60px;
}

.heading-5 {
  margin-bottom: 30px;
  color: #11142d;
  font-size: 28px;
  font-weight: 800;
  letter-spacing: 0.5px;
}

.paragraph-5 {
  color: #515151;
  font-size: 12px;
  line-height: 140%;
}

.paragraph-6 {
  color: #515151;
  line-height: 125%;
}

.div-block-10 {
  margin-left: 0px;
}

.div-block-11 {
  padding-top: 10px;
}

.div-block-12 {
  padding-top: 100px;
  padding-bottom: 0px;
}

.grid-4 {
  grid-column-gap: 92px;
  -ms-grid-rows: auto;
  grid-template-rows: auto;
}

.grid-5 {
  -ms-grid-rows: auto;
  grid-template-rows: auto;
}

.div-block-13 {
  margin-top: 60px;
}

.div-block-14 {
  margin-top: 0px;
  padding-top: 10px;
}

.banner-section {
  background-color: #2d9cdb;
  color: #fff;
}

.grid-6 {
  grid-column-gap: 0px;
  -ms-grid-rows: auto;
  grid-template-rows: auto;
}

.div-block-15 {
  background-color: transparent;
}

.div-block-16 {
  padding-left: 100px;
  font-size: 30px;
}

.heading-6 {
  font-size: 28px;
  line-height: 18px;
  font-weight: 800;
}

.heading-7 {
  font-size: 28px;
  line-height: 18px;
}

.heading-8 {
  font-size: 28px;
  line-height: 18px;
}

.heading-9 {
  font-size: 28px;
  line-height: 18px;
}

.gallery-section {
  background-color: #fff;
  color: #fff;
}

.container-2 {
  padding-top: 100px;
}

.grid-7 {
  grid-column-gap: 9px;
  -ms-grid-columns: 1fr minmax(200px, 1fr) 1fr;
  grid-template-columns: 1fr minmax(200px, 1fr) 1fr;
  -ms-grid-rows: auto;
  grid-template-rows: auto;
}

.grid-8 {
  justify-items: stretch;
  -webkit-box-align: stretch;
  -webkit-align-items: stretch;
  -ms-flex-align: stretch;
  align-items: stretch;
  -webkit-align-content: space-between;
  -ms-flex-line-pack: justify;
  align-content: space-between;
  grid-row-gap: 10px;
  -ms-grid-columns: 1fr;
  grid-template-columns: 1fr;
  -ms-grid-rows: auto auto;
  grid-template-rows: auto auto;
}

.grid-9 {
  grid-column-gap: 10px;
  grid-row-gap: 9px;
  -ms-grid-columns: 1fr;
  grid-template-columns: 1fr;
  -ms-grid-rows: 167px 344px;
  grid-template-rows: 167px 344px;
}

.footer-section {
  padding-bottom: 10px;
  background-color: #fff;
}

.div-block-17 {
  padding-top: 100px;
  padding-bottom: 0px;
}

.grid-10 {
  grid-column-gap: 38px;
  -ms-grid-columns: 0.5fr 0.5fr 0.5fr 1fr;
  grid-template-columns: 0.5fr 0.5fr 0.5fr 1fr;
  -ms-grid-rows: auto;
  grid-template-rows: auto;
}

.heading-10 {
  margin-top: 0px;
  padding-left: 0px;
  color: #11142d;
  font-size: 16px;
  line-height: 20px;
  text-align: left;
  letter-spacing: 0.5px;
}

.grid-11 {
  padding-top: 10px;
  grid-column-gap: 10px;
  -ms-grid-columns: 0.25fr 2.75fr;
  grid-template-columns: 0.25fr 2.75fr;
  -ms-grid-rows: auto auto auto;
  grid-template-rows: auto auto auto;
}

.heading-11 {
  margin-top: 4px;
  color: #515151;
  font-size: 12px;
  font-weight: 400;
}

.heading-12 {
  margin-top: 4px;
  color: #515151;
  font-size: 12px;
  font-weight: 400;
}

.heading-13 {
  margin-top: 4px;
  color: #515151;
  font-size: 12px;
  font-weight: 400;
}

.div-block-18 {
  padding-top: 10px;
}

.div-block-19 {
  padding-top: 10px;
}

.heading-14 {
  margin-top: 60px;
  color: #11142d;
  font-size: 16px;
  font-weight: 600;
}

.grid-12 {
  height: 500px;
  max-height: 500px;
  min-height: 500px;
  -ms-grid-columns: 1fr 1fr 1fr;
  grid-template-columns: 1fr 1fr 1fr;
  -ms-grid-rows: auto;
  grid-template-rows: auto;
}

.main-section {
  position: relative;
  background-image: url('/images/22.webp');
  background-position: 0px 0px;
  background-size: cover;
}

.image-5 {
  max-width: 70%;
}

.image-6 {
  padding-top: 20px;
}

.nav-menu-2 {
  padding-top: 40px;
}

.body-2 {
  font-family: Mulish, sans-serif;
}

.navbar-2 {
  background-color: transparent;
}

.div-block-22 {
  position: static;
  left: 0%;
  top: auto;
  right: auto;
  bottom: 0%;
  background-image: -webkit-gradient(linear, left bottom, left top, from(#000), to(#fff));
  background-image: linear-gradient(0deg, #000, #fff);
  opacity: 0.46;
}

.div-block-23 {
  text-align: center;
}

.heading-15 {
  color: #e5e5e5;
}

.container-5 {
  padding-top: 20px;
  padding-bottom: 90px;
}

.nav-link-4 {
  color: #fff;
}

.nav-link-5 {
  color: #fff;
}

.nav-link-6 {
  color: #fff;
}

.nav-link-7 {
  color: #fff;
}

.nav-link-8 {
  color: #fff;
}

.events {
  background-color: #fff;
}

.container-6 {
  padding-top: 100px;
  padding-bottom: 60px;
}

.grid-14 {
  -ms-grid-columns: 1.75fr 1fr;
  grid-template-columns: 1.75fr 1fr;
  -ms-grid-rows: auto;
  grid-template-rows: auto;
}

.div-block-24 {
  border-radius: 8px;
  background-color: #f6f6f7;
}

.div-block-25 {
  border-radius: 8px;
  background-color: #f6f6f7;
}

.div-block-26 {
  padding-top: 40px;
}

.grid-15 {
  grid-column-gap: 16px;
  -ms-grid-rows: auto;
  grid-template-rows: auto;
}

.grid-16 {
  grid-row-gap: 10px;
  -ms-grid-columns: 1fr;
  grid-template-columns: 1fr;
}

.grid-17 {
  grid-row-gap: 10px;
  -ms-grid-columns: 1fr;
  grid-template-columns: 1fr;
}

.heading-16 {
  margin-top: 10px;
  color: #11142d;
}

.paragraph-7 {
  color: #515151;
}

.link {
  border-bottom: 3px solid #2d9cdb;
  color: #2d9cdb;
  font-size: 16px;
  font-weight: 700;
  text-decoration: none;
}

.link:hover {
  color: #11142d;
}

.div-block-27 {
  padding-top: 30px;
}

.div-block-28 {
  padding-top: 80px;
}

.div-block-29 {
  color: #515151;
}

.body-3 {
  font-family: Mulish, sans-serif;
}

.about {
  background-image: url('/images/26.webp');
  background-position: 0px 0px;
  background-size: cover;
}

.container-7 {
  padding-top: 100px;
  padding-bottom: 40px;
}

.container-8 {
  padding-top: 60px;
}

.div-block-30 {
  padding-top: 10px;
  padding-bottom: 20px;
}

.grid-18 {
  grid-column-gap: 16px;
  -ms-grid-columns: 1fr 1fr 1fr 1fr;
  grid-template-columns: 1fr 1fr 1fr 1fr;
  -ms-grid-rows: auto;
  grid-template-rows: auto;
}

.heading-17 {
  color: #11142d;
  font-size: 24px;
}

.paragraph-8 {
  color: #515151;
}

.div-block-31 {
  padding: 20px 10px 40px;
}

.div-block-31:hover {
  border-radius: 0px;
  box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.24);
}

.div-block-32 {
  position: static;
  height: 100%;
  max-height: 100%;
  min-height: 100%;
  margin-top: 100px;
  padding-top: 0px;
  padding-bottom: 0px;
}

.div-block-33 {
  position: static;
  left: 0%;
  top: 15%;
  right: 0%;
  bottom: auto;
  margin: 0px 40px;
  padding: 10px 0px;
  border-radius: 8px;
  background-color: #fff;
}

.grid-19 {
  position: relative;
  z-index: 1;
  overflow: auto;
  margin-right: 0px;
  margin-left: 20px;
  padding-top: 10px;
  padding-bottom: 10px;
  grid-column-gap: 390px;
  -ms-grid-columns: 1.25fr 1fr;
  grid-template-columns: 1.25fr 1fr;
  -ms-grid-rows: auto;
  grid-template-rows: auto;
  border-radius: 8px;
  background-color: #fff;
}

.paragraph-9 {
  color: #515151;
}

.heading-18 {
  margin-top: 10px;
  color: #11142d;
  font-size: 18px;
}

.div-block-34 {
  padding-left: 20px;
  background-color: #fff;
}

.div-block-35 {
  margin-right: 0px;
  padding-right: 20px;
}

.div-block-36 {
  position: static;
  margin-top: -116px;
  margin-right: 20px;
  margin-left: 0px;
  padding-right: 0px;
  border-radius: 8px;
  background-color: transparent;
}

.body-4 {
  font-family: Mulish, sans-serif;
}

.contact {
  background-image: url('/images/25.webp');
  background-position: 50% 50%;
  background-size: cover;
}

.container-9 {
  padding-bottom: 60px;
}

.grid-20 {
  -ms-grid-columns: 1fr;
  grid-template-columns: 1fr;
}

.grid-21 {
  -ms-grid-columns: 1fr;
  grid-template-columns: 1fr;
}

.image-7 {
  height: 96%;
  max-width: 104%;
  min-height: auto;
}

.image-8 {
  height: 104.5%;
}

.image-9 {
  height: 102.5%;
}

.body-5 {
  font-family: Mulish, sans-serif;
}

.container-11 {
  padding-top: 100px;
  padding-bottom: 10px;
}

.grid-22 {
  -ms-grid-columns: 1fr 1fr 1fr;
  grid-template-columns: 1fr 1fr 1fr;
  -ms-grid-rows: auto;
  grid-template-rows: auto;
}

.div-block-37 {
  width: auto;
  height: 100%;
  min-height: 100%;
}

.image-10 {
  min-height: 100%;
}

.image-11 {
  min-height: 100%;
}

.grid-23 {
  padding-top: 16px;
  -ms-grid-columns: 1fr;
  grid-template-columns: 1fr;
  -ms-grid-rows: auto;
  grid-template-rows: auto;
}

.image-12 {
  max-width: 100%;
  min-width: 100%;
}

.grid-24 {
  -ms-grid-columns: 1fr 1fr 1fr;
  grid-template-columns: 1fr 1fr 1fr;
  -ms-grid-rows: auto;
  grid-template-rows: auto;
}

.div-block-38 {
  padding-top: 60px;
  text-align: center;
}

.image-14 {
  max-width: 20%;
}

.image-15 {
  max-width: 20%;
}

.image-16 {
  max-width: 20%;
}

.image-17 {
  max-width: 20%;
}

.div-block-39 {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-pack: start;
  -webkit-justify-content: flex-start;
  -ms-flex-pack: start;
  justify-content: flex-start;
  -webkit-box-align: center;
  -webkit-align-items: center;
  -ms-flex-align: center;
  align-items: center;
}

.body-6 {
  font-family: Mulish, sans-serif;
}

.section {
  padding-top: 100px;
  padding-bottom: 100px;
}

.grid-26 {
  -webkit-box-align: start;
  -webkit-align-items: start;
  -ms-flex-align: start;
  align-items: start;
  -webkit-align-content: stretch;
  -ms-flex-line-pack: stretch;
  align-content: stretch;
  grid-column-gap: 0px;
  -ms-grid-columns: 0.5fr 0.5fr;
  grid-template-columns: 0.5fr 0.5fr;
  -ms-grid-rows: auto;
  grid-template-rows: auto;
}

.heading-19 {
  color: #11142d;
}

.heading-20 {
  margin-top: 0px;
  margin-bottom: 20px;
  font-size: 16px;
  line-height: 20px;
  font-weight: 800;
}

.paragraph-10 {
  color: #515151;
  font-size: 10px;
  line-height: 14px;
}

.div-block-40 {
  padding-top: 10px;
}

.div-block-41 {
  padding-top: 10px;
}

.heading-21 {
  color: #11142d;
  font-size: 32px;
}

.heading-22 {
  color: #11142d;
  font-size: 20px;
  text-align: center;
}

.div-block-42 {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  padding-top: 10px;
  -webkit-box-pack: center;
  -webkit-justify-content: center;
  -ms-flex-pack: center;
  justify-content: center;
  -webkit-box-align: center;
  -webkit-align-items: center;
  -ms-flex-align: center;
  align-items: center;
}

.div-block-43 {
  margin-left: 20px;
}

@media screen and (min-width: 1280px) {
  .hero-section {
    height: 100.0000527288929%;
    min-height: 100%;
  }

  .brand {
    left: 25%;
  }

  .navbar {
    padding-top: 20px;
  }

  .nav-menu {
    padding-top: 50px;
  }

  .heading {
    font-size: 52px;
  }

  .paragraph {
    font-size: 18px;
    line-height: 30px;
  }

  .container {
    position: relative;
    left: 0%;
    top: 15%;
    right: 0%;
    bottom: 0%;
  }

  .div-block {
    bottom: -40%;
    padding-top: 40px;
    padding-bottom: 50px;
  }

  .div-block-2 {
    padding-top: 160px;
  }

  .grid {
    -webkit-box-align: start;
    -webkit-align-items: start;
    -ms-flex-align: start;
    align-items: start;
  }

  .div-block-5 {
    margin-left: 100px;
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
    -webkit-flex-direction: row;
    -ms-flex-direction: row;
    flex-direction: row;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
  }

  .div-block-6 {
    padding-right: 100px;
  }

  .div-block-8 {
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
    -webkit-flex-direction: row;
    -ms-flex-direction: row;
    flex-direction: row;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
  }

  .heading-5 {
    font-size: 32px;
  }

  .div-block-10 {
    font-size: 16px;
  }

  .div-block-16 {
    padding-left: 160px;
  }

  .heading-6 {
    font-size: 34px;
    line-height: 28px;
  }

  .heading-7 {
    font-size: 34px;
    line-height: 28px;
  }

  .heading-8 {
    font-size: 34px;
  }

  .heading-9 {
    font-size: 34px;
    line-height: 28px;
  }

  .grid-7 {
    -ms-grid-columns: 1fr minmax(215px, 1fr) 1fr;
    grid-template-columns: 1fr minmax(215px, 1fr) 1fr;
  }

  .grid-8 {
    -ms-grid-rows: 449px 210px;
    grid-template-rows: 449px 210px;
  }

  .grid-12 {
    grid-column-gap: 10px;
    grid-row-gap: 10px;
    -ms-grid-columns: 1fr 1fr 1fr;
    grid-template-columns: 1fr 1fr 1fr;
    -ms-grid-rows: auto;
    grid-template-rows: auto;
  }

  .grid-13 {
    -ms-grid-rows: auto;
    grid-template-rows: auto;
  }

  .container-5 {
    padding-bottom: 100px;
  }

  .image-8 {
    height: 104.5%;
  }
}

@media screen and (min-width: 1440px) {
  .div-block {
    bottom: -54%;
  }

  .div-block-2 {
    padding-top: 180px;
  }

  .div-block-5 {
    margin-left: 115px;
  }

  .div-block-6 {
    padding-right: 140px;
  }

  .div-block-16 {
    padding-left: 175px;
  }

  .heading-6 {
    font-size: 38px;
    line-height: 32px;
  }

  .heading-7 {
    font-size: 38px;
    line-height: 32px;
  }

  .heading-8 {
    font-size: 38px;
    line-height: 32px;
  }

  .heading-9 {
    font-size: 38px;
    line-height: 32px;
  }

  .container-5 {
    padding-top: 60px;
    padding-bottom: 123px;
  }

  .grid-24 {
    -ms-grid-columns: 1fr 1fr 1fr;
    grid-template-columns: 1fr 1fr 1fr;
    -ms-grid-rows: auto;
    grid-template-rows: auto;
  }

  .grid-25 {
    -ms-grid-rows: auto;
    grid-template-rows: auto;
  }

  .image-13 {
    min-height: 92%;
  }
}

@media screen and (min-width: 1920px) {
  .heading {
    font-size: 64px;
  }

  .paragraph {
    font-size: 22px;
    line-height: 38px;
  }

  .container {
    top: 20%;
  }

  .div-block {
    bottom: -69%;
    padding-top: 60px;
    padding-bottom: 60px;
  }

  .div-block-2 {
    padding-top: 220px;
  }

  .div-block-5 {
    margin-left: 220px;
  }

  .div-block-6 {
    padding-right: 220px;
  }

  .div-block-16 {
    padding-left: 300px;
    font-size: 42px;
  }

  .heading-6 {
    font-size: 38px;
    line-height: 38px;
  }

  .heading-7 {
    font-size: 38px;
    line-height: 38px;
  }

  .heading-8 {
    font-size: 38px;
    line-height: 38px;
  }

  .heading-9 {
    font-size: 38px;
    line-height: 38px;
  }
}

@media screen and (max-width: 991px) {
  .div-block {
    bottom: -32%;
  }

  .heading-3 {
    font-size: 18px;
  }

  .paragraph-3 {
    font-size: 12px;
  }

  .heading-4 {
    font-size: 18px;
  }

  .paragraph-4 {
    font-size: 12px;
  }

  .button {
    padding: 10px 20px;
    font-size: 12px;
  }

  .heading-5 {
    font-size: 22px;
  }

  .paragraph-5 {
    font-size: 10px;
  }

  .paragraph-6 {
    font-size: 12px;
  }

  .heading-6 {
    font-size: 22px;
  }

  .heading-7 {
    font-size: 22px;
  }

  .heading-8 {
    font-size: 22px;
  }

  .heading-9 {
    font-size: 22px;
  }

  .div-block-17 {
    padding-top: 20px;
  }

  .grid-10 {
    grid-column-gap: 14px;
    -ms-grid-columns: 0.5fr 0.5fr 0.5fr 1fr;
    grid-template-columns: 0.5fr 0.5fr 0.5fr 1fr;
  }

  .heading-10 {
    font-size: 12px;
  }

  .heading-11 {
    margin-top: 2px;
    font-size: 10px;
  }

  .heading-12 {
    margin-top: 2px;
    font-size: 10px;
  }

  .heading-13 {
    margin-top: 2px;
    font-size: 10px;
  }

  .heading-14 {
    font-size: 12px;
  }

  .menu-button {
    color: #2d9cdb;
  }

  .div-block-20 {
    font-size: 12px;
  }

  .heading-15 {
    font-size: 24px;
  }

  .heading-16 {
    font-size: 20px;
  }

  .paragraph-7 {
    font-size: 12px;
  }

  .link {
    font-size: 12px;
  }

  .menu-button-2 {
    color: #2d9cdb;
  }

  .paragraph-8 {
    font-size: 12px;
  }

  .grid-19 {
    grid-column-gap: 181px;
    -ms-grid-columns: 1.25fr 1.25fr;
    grid-template-columns: 1.25fr 1.25fr;
  }

  .paragraph-9 {
    font-size: 12px;
  }

  .heading-18 {
    font-size: 12px;
  }

  .image-7 {
    height: 77%;
    max-width: 100%;
  }
}

@media screen and (max-width: 767px) {
  .div-block {
    bottom: -33%;
    display: none;
  }

  .div-block-2 {
    display: block;
    padding-top: 100px;
  }

  .grid {
    grid-column-gap: 21px;
  }

  .heading-3 {
    font-size: 14px;
  }

  .div-block-5 {
    margin-left: 10px;
  }

  .div-block-6 {
    padding-right: 10px;
  }

  .heading-4 {
    font-size: 14px;
  }

  .grid-2 {
    display: block;
  }

  .heading-5 {
    font-size: 18px;
    line-height: 26px;
  }

  .paragraph-5 {
    font-size: 12px;
    line-height: 140%;
  }

  .div-block-12 {
    display: block;
  }

  .grid-4 {
    display: block;
  }

  .grid-5 {
    padding-top: 100px;
  }

  .div-block-16 {
    padding-left: 40px;
  }

  .heading-6 {
    font-size: 18px;
  }

  .heading-7 {
    font-size: 18px;
  }

  .heading-8 {
    font-size: 18px;
  }

  .heading-9 {
    font-size: 18px;
  }

  .container-2 {
    margin-bottom: -154px;
    padding-top: 100px;
    padding-right: 10px;
    padding-left: 10px;
  }

  .grid-10 {
    display: block;
    grid-column-gap: 8px;
    -ms-grid-columns: 1fr 1.25fr 1.25fr 0.25fr;
    grid-template-columns: 1fr 1.25fr 1.25fr 0.25fr;
  }

  .heading-10 {
    padding-top: 10px;
    padding-bottom: 10px;
    font-size: 14px;
  }

  .grid-11 {
    grid-column-gap: 22px;
    -ms-grid-columns: 0.25fr 3.25fr;
    grid-template-columns: 0.25fr 3.25fr;
  }

  .heading-11 {
    margin-top: 2px;
  }

  .heading-12 {
    margin-top: 2px;
  }

  .heading-13 {
    margin-top: 2px;
  }

  .container-3 {
    padding-right: 10px;
    padding-left: 10px;
  }

  .div-block-21 {
    margin-top: 0px;
  }

  .container-4 {
    padding-right: 10px;
    padding-left: 10px;
  }

  .image-2 {
    max-width: 60%;
  }

  .image-3 {
    max-width: 50%;
  }

  .image-4 {
    max-width: 50%;
  }

  .container-5 {
    padding-right: 10px;
    padding-left: 10px;
  }

  .container-6 {
    padding-right: 10px;
    padding-left: 10px;
  }

  .menu-button-2 {
    color: #2d9cdb;
  }

  .container-7 {
    padding-right: 10px;
    padding-left: 10px;
  }

  .container-8 {
    padding-right: 10px;
    padding-left: 10px;
  }

  .grid-18 {
    -ms-grid-columns: 1fr 1fr;
    grid-template-columns: 1fr 1fr;
  }

  .grid-19 {
    grid-column-gap: 93px;
  }

  .paragraph-9 {
    margin-bottom: 0px;
    font-size: 10px;
  }

  .heading-18 {
    margin-top: 0px;
    margin-bottom: 0px;
    font-size: 12px;
  }

  .div-block-36 {
    margin-top: -91px;
  }

  .image-7 {
    height: 58%;
  }

  .container-11 {
    padding-right: 10px;
    padding-left: 10px;
  }

  .grid-26 {
    padding-top: 20px;
  }
}

@media screen and (max-width: 479px) {
  .brand {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-box-align: end;
    -webkit-align-items: flex-end;
    -ms-flex-align: end;
    align-items: flex-end;
    text-align: center;
  }

  .nav-menu {
    padding-right: 10px;
    padding-bottom: 40px;
    padding-left: 10px;
    background-color: #11142d;
  }

  .image {
    max-width: 90%;
    -webkit-box-flex: 0;
    -webkit-flex: 0 auto;
    -ms-flex: 0 auto;
    flex: 0 auto;
  }

  .heading {
    font-size: 28px;
  }

  .paragraph {
    font-size: 12px;
  }

  .grid-6 {
    display: block;
  }

  .div-block-16 {
    padding-bottom: 20px;
  }

  .container-2 {
    margin-bottom: -270px;
    padding-top: 20px;
  }

  .div-block-17 {
    padding-top: 40px;
  }

  .grid-11 {
    -ms-grid-columns: 0.5fr 3.25fr;
    grid-template-columns: 0.5fr 3.25fr;
  }

  .menu-button.w--open {
    background-color: #11142d;
  }

  .nav-menu-2 {
    position: absolute;
    left: 0%;
    top: 50%;
    right: 0%;
    bottom: auto;
    z-index: 1;
    display: inline-block;
    margin-top: 0px;
    padding: 40px 10px 20px;
    background-color: #11142d;
  }

  .container-5 {
    padding-right: 10px;
    padding-left: 10px;
  }

  .container-6 {
    padding-bottom: 0px;
  }

  .grid-15 {
    display: block;
  }

  .heading-16 {
    font-size: 16px;
  }

  .menu-button-2 {
    position: relative;
    top: 0px;
    color: #2d9cdb;
  }

  .menu-button-2.w--open {
    background-color: #11142d;
  }

  .grid-18 {
    -ms-grid-columns: 1fr;
    grid-template-columns: 1fr;
  }

  .div-block-32 {
    display: none;
  }

  .container-10 {
    display: block;
  }

  .image-7 {
    height: 36%;
  }

  .icon {
    margin-top: 0px;
  }

  .grid-26 {
    -ms-grid-columns: 0.75fr 0.5fr;
    grid-template-columns: 0.75fr 0.5fr;
  }
}

#w-node-c0194ae0-6f01-f412-c3f3-8c9e5a4976cb-b5a84b13 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-row-align: center;
  align-self: center;
  -ms-grid-column-align: stretch;
  justify-self: stretch;
}

#w-node-d95610bf-bae5-da05-ad29-27a0d20fe707-b5a84b13 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_1e5210d8-f43d-d7f9-dd70-bacb891cd703-b5a84b13 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_43e517c2-020e-9e08-edfa-4f6266ac407d-b5a84b13 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_91bedd48-2583-0c15-1adf-5e0696ce7b81-b5a84b13 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-row-align: center;
  align-self: center;
}

#w-node-_84d9da0c-e34b-51fd-a7a7-36e66481dc71-b5a84b13 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-row-align: center;
  align-self: center;
  -ms-grid-column-align: end;
  justify-self: end;
}

#w-node-a14fd459-4267-ecc2-1926-19c924158524-b5a84b13 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-da97c73e-57e2-b1cd-f665-a1b02e73308d-b5a84b13 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-column-align: center;
  justify-self: center;
  -ms-grid-row-align: center;
  align-self: center;
}

#w-node-_07686d12-8e75-4ce9-c131-91dd8aa12a67-b5a84b13 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_95c120b3-aa55-9876-464e-f69f89f94677-b5a84b13 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_9c055f86-8b68-3c6e-4f31-05466eb2a6e6-b5a84b13 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_9927f0f7-d9f9-4cb2-d6a0-88d0a2548b4c-b5a84b13 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-eeb3cd6c-ab3c-32ff-a5ac-deb98b01d831-b5a84b13 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-column-align: stretch;
  justify-self: stretch;
  -ms-grid-row-align: center;
  align-self: center;
}

#w-node-ae7c648e-66b0-536a-827e-4e76233a0927-b5a84b13 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_59931ce0-5e56-236b-524b-88dc8e4c1562-b5a84b13 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_6302015f-cf70-fe75-71cc-76d6cccc0f50-b5a84b13 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-fd8faff3-ac0e-53e1-817f-da6a2c65a748-b5a84b13 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_8c4d655b-e0d4-7752-cd9d-9ff4acb02d03-b5a84b13 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_7aea8979-c569-c89c-1dd2-72080cfee747-b5a84b13 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-c7dcb362-18d4-d1fb-467d-011308c2f8be-b5a84b13 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_02d47209-7f69-f6ac-efb3-10ae17829d7e-b5a84b13 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-ea50531f-4263-c568-cc49-6f7a1024e3f9-b5a84b13 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-row-align: start;
  align-self: start;
}

#w-node-d79204e9-6a71-909b-8b63-070778ed3dc7-b5a84b13 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-ef6687b5-37ed-2755-78d5-5bfb4e29f9eb-b5a84b13 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_282152f2-4872-b5c6-4a38-e615f5c1a003-b5a84b13 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-row-align: start;
  align-self: start;
}

#w-node-_40c5f859-5786-53a1-39be-b678ddbacd56-b5a84b13 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_7bab0343-76e0-d7f0-919b-6c4175c72bb5-b5a84b13 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_1533551e-2849-f0bf-9479-2e925e545d29-b5a84b13 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-row-align: start;
  align-self: start;
}

#w-node-_47e5aff7-874e-52c9-045a-84fe8c68c385-b5a84b13 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_8ba039fa-7113-8084-3abd-ea1cc74bd5f1-b5a84b13 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-b56d7c11-3533-446a-9f2c-a4eaf3e133d9-b5a84b13 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-row-align: start;
  align-self: start;
}

#w-node-_7c2092a7-786e-3fce-4a55-b867e09686d2-b5a84b13 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_2672fe8e-b26c-a35f-71f8-2191f43ed520-b5a84b13 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-row-align: start;
  align-self: start;
}

#w-node-ae45a09d-c61f-c5ed-b0e0-ba62358da8b6-b5a84b13 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-row-align: auto;
  align-self: auto;
}

#w-node-_8831a1ae-69b4-4c66-42c9-16dfe114eb08-b5a84b13 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-fc1b37b1-f0df-ac54-e1ec-7dec7fbe4d1a-b5a84b13 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_9a8c6244-0816-b407-bda3-415b577fda87-e30a8bda {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-row-align: center;
  align-self: center;
}

#w-node-_44b47dcc-fa36-a317-2391-ac345425520d-e30a8bda {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-row-align: center;
  align-self: center;
}

#w-node-_63f0f9a8-7dc0-ac4c-1892-a756653ae65e-e30a8bda {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_346e9f91-eb85-6676-fc75-91adb38748b7-e30a8bda {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-abe0d26a-7e21-ffd5-2fad-088e6ed55d82-e30a8bda {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-af49435c-506a-fead-5315-ee4a544c1192-e30a8bda {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-f0a1d9e4-2a73-2c92-b04c-88482815aa9a-e30a8bda {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-c7a306c7-7632-836b-c4de-7838215c6bdd-e30a8bda {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_4232e0c6-0a09-823f-32e9-df9d972625d7-e30a8bda {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_4232e0c6-0a09-823f-32e9-df9d972625d9-e30a8bda {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_4232e0c6-0a09-823f-32e9-df9d972625db-e30a8bda {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_4232e0c6-0a09-823f-32e9-df9d972625e3-e30a8bda {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_4232e0c6-0a09-823f-32e9-df9d972625e5-e30a8bda {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_4232e0c6-0a09-823f-32e9-df9d972625e7-e30a8bda {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_254a3667-04af-9272-e671-61cf2c3f87a3-e30a8bda {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_254a3667-04af-9272-e671-61cf2c3f87a6-e30a8bda {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-row-align: start;
  align-self: start;
}

#w-node-_254a3667-04af-9272-e671-61cf2c3f87aa-e30a8bda {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_254a3667-04af-9272-e671-61cf2c3f87ab-e30a8bda {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_254a3667-04af-9272-e671-61cf2c3f87ac-e30a8bda {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-row-align: start;
  align-self: start;
}

#w-node-_254a3667-04af-9272-e671-61cf2c3f87af-e30a8bda {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_254a3667-04af-9272-e671-61cf2c3f87b0-e30a8bda {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_254a3667-04af-9272-e671-61cf2c3f87b1-e30a8bda {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-row-align: start;
  align-self: start;
}

#w-node-_254a3667-04af-9272-e671-61cf2c3f87b4-e30a8bda {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_254a3667-04af-9272-e671-61cf2c3f87b5-e30a8bda {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_254a3667-04af-9272-e671-61cf2c3f87b6-e30a8bda {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-row-align: start;
  align-self: start;
}

#w-node-_254a3667-04af-9272-e671-61cf2c3f87b9-e30a8bda {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_254a3667-04af-9272-e671-61cf2c3f87c2-e30a8bda {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-row-align: start;
  align-self: start;
}

#w-node-_254a3667-04af-9272-e671-61cf2c3f87c4-e30a8bda {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-row-align: auto;
  align-self: auto;
}

#w-node-_254a3667-04af-9272-e671-61cf2c3f87cf-e30a8bda {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_254a3667-04af-9272-e671-61cf2c3f87d1-e30a8bda {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_37b0321c-68c3-ad18-15ee-d00480dbb007-2ef08568 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_37b0321c-68c3-ad18-15ee-d00480dbb009-2ef08568 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_37b0321c-68c3-ad18-15ee-d00480dbb00b-2ef08568 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-row-align: center;
  align-self: center;
}

#w-node-_37b0321c-68c3-ad18-15ee-d00480dbb00d-2ef08568 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-row-align: center;
  align-self: center;
  -ms-grid-column-align: end;
  justify-self: end;
}

#w-node-_37b0321c-68c3-ad18-15ee-d00480dbb00e-2ef08568 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-a438fb16-e6ef-f9c0-d982-d650e60c8736-2ef08568 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-row-align: auto;
  align-self: auto;
}

#w-node-a1daf4a6-4c4e-3882-9297-d5addd499193-2ef08568 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-aee8cffd-e2c6-fa06-2cb6-4a68047f7f33-2ef08568 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_1e222ec4-b9d2-8ea6-30a6-0e18f9f8b2b9-2ef08568 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_30443203-242b-9df6-e28b-ed8d2fb1e49b-2ef08568 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-column-align: center;
  justify-self: center;
}

#w-node-bbdfb452-4055-1ce9-bcf1-80808e6d6ab5-2ef08568 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-row-align: center;
  align-self: center;
  -ms-grid-column-align: end;
  justify-self: end;
}

#w-node-b2b01900-e8ee-fac7-d03d-bbe1ce0650aa-2ef08568 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-b2b01900-e8ee-fac7-d03d-bbe1ce0650ad-2ef08568 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-row-align: start;
  align-self: start;
}

#w-node-b2b01900-e8ee-fac7-d03d-bbe1ce0650b1-2ef08568 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-b2b01900-e8ee-fac7-d03d-bbe1ce0650b2-2ef08568 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-b2b01900-e8ee-fac7-d03d-bbe1ce0650b3-2ef08568 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-row-align: start;
  align-self: start;
}

#w-node-b2b01900-e8ee-fac7-d03d-bbe1ce0650b6-2ef08568 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-b2b01900-e8ee-fac7-d03d-bbe1ce0650b7-2ef08568 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-b2b01900-e8ee-fac7-d03d-bbe1ce0650b8-2ef08568 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-row-align: start;
  align-self: start;
}

#w-node-b2b01900-e8ee-fac7-d03d-bbe1ce0650bb-2ef08568 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-b2b01900-e8ee-fac7-d03d-bbe1ce0650bc-2ef08568 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-b2b01900-e8ee-fac7-d03d-bbe1ce0650bd-2ef08568 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-row-align: start;
  align-self: start;
}

#w-node-b2b01900-e8ee-fac7-d03d-bbe1ce0650c0-2ef08568 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-b2b01900-e8ee-fac7-d03d-bbe1ce0650c9-2ef08568 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-row-align: start;
  align-self: start;
}

#w-node-b2b01900-e8ee-fac7-d03d-bbe1ce0650cb-2ef08568 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-row-align: auto;
  align-self: auto;
}

#w-node-b2b01900-e8ee-fac7-d03d-bbe1ce0650d6-2ef08568 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-b2b01900-e8ee-fac7-d03d-bbe1ce0650d8-2ef08568 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-c8e4d9d2-9e71-b116-5bb2-6496da9ad9b4-8ea60539 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-column-align: center;
  justify-self: center;
}

#w-node-c8e4d9d2-9e71-b116-5bb2-6496da9ad9b9-8ea60539 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-row-align: center;
  align-self: center;
  -ms-grid-column-align: end;
  justify-self: end;
}

#w-node-_253031e7-90d0-10d4-d591-50e7e143beaa-8ea60539 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_253031e7-90d0-10d4-d591-50e7e143bead-8ea60539 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-row-align: start;
  align-self: start;
}

#w-node-_253031e7-90d0-10d4-d591-50e7e143beb1-8ea60539 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_253031e7-90d0-10d4-d591-50e7e143beb2-8ea60539 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_253031e7-90d0-10d4-d591-50e7e143beb3-8ea60539 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-row-align: start;
  align-self: start;
}

#w-node-_253031e7-90d0-10d4-d591-50e7e143beb6-8ea60539 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_253031e7-90d0-10d4-d591-50e7e143beb7-8ea60539 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_253031e7-90d0-10d4-d591-50e7e143beb8-8ea60539 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-row-align: start;
  align-self: start;
}

#w-node-_253031e7-90d0-10d4-d591-50e7e143bebb-8ea60539 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_253031e7-90d0-10d4-d591-50e7e143bebc-8ea60539 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_253031e7-90d0-10d4-d591-50e7e143bebd-8ea60539 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-row-align: start;
  align-self: start;
}

#w-node-_253031e7-90d0-10d4-d591-50e7e143bec0-8ea60539 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_253031e7-90d0-10d4-d591-50e7e143bec9-8ea60539 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-row-align: start;
  align-self: start;
}

#w-node-_253031e7-90d0-10d4-d591-50e7e143becb-8ea60539 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-row-align: auto;
  align-self: auto;
}

#w-node-_253031e7-90d0-10d4-d591-50e7e143bed6-8ea60539 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_253031e7-90d0-10d4-d591-50e7e143bed8-8ea60539 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-b0a36f6a-a972-b028-146e-a98fced0cec7-6ba7dd61 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-f0f8c76d-f184-ed8f-fd4d-9878aa363d02-6ba7dd61 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_5e5ef061-e800-342c-81bc-646780b6ac0f-6ba7dd61 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-c0b233a5-5e5d-f360-12cd-d04e0f09e1d8-6ba7dd61 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_90eb2804-50ca-06f3-53cf-9d275d70ed6c-6ba7dd61 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-ea805919-ca58-6933-0af1-8d0beddf0453-6ba7dd61 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_0c802fa7-1f03-a054-9598-0b6e4a621be6-6ba7dd61 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_0c802fa7-1f03-a054-9598-0b6e4a621be9-6ba7dd61 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-row-align: start;
  align-self: start;
}

#w-node-_0c802fa7-1f03-a054-9598-0b6e4a621bed-6ba7dd61 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_0c802fa7-1f03-a054-9598-0b6e4a621bee-6ba7dd61 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_0c802fa7-1f03-a054-9598-0b6e4a621bef-6ba7dd61 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-row-align: start;
  align-self: start;
}

#w-node-_0c802fa7-1f03-a054-9598-0b6e4a621bf2-6ba7dd61 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_0c802fa7-1f03-a054-9598-0b6e4a621bf3-6ba7dd61 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_0c802fa7-1f03-a054-9598-0b6e4a621bf4-6ba7dd61 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-row-align: start;
  align-self: start;
}

#w-node-_0c802fa7-1f03-a054-9598-0b6e4a621bf7-6ba7dd61 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_0c802fa7-1f03-a054-9598-0b6e4a621bf8-6ba7dd61 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_0c802fa7-1f03-a054-9598-0b6e4a621bf9-6ba7dd61 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-row-align: start;
  align-self: start;
}

#w-node-_0c802fa7-1f03-a054-9598-0b6e4a621bfc-6ba7dd61 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_0c802fa7-1f03-a054-9598-0b6e4a621c05-6ba7dd61 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-row-align: start;
  align-self: start;
}

#w-node-_0c802fa7-1f03-a054-9598-0b6e4a621c07-6ba7dd61 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-row-align: auto;
  align-self: auto;
}

#w-node-_0c802fa7-1f03-a054-9598-0b6e4a621c12-6ba7dd61 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_0c802fa7-1f03-a054-9598-0b6e4a621c14-6ba7dd61 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_260c6ab4-3932-0ec5-add0-2c7294cf80ba-e08abbc6 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_260c6ab4-3932-0ec5-add0-2c7294cf80bd-e08abbc6 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-row-align: start;
  align-self: start;
}

#w-node-_260c6ab4-3932-0ec5-add0-2c7294cf80c1-e08abbc6 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_260c6ab4-3932-0ec5-add0-2c7294cf80c2-e08abbc6 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_260c6ab4-3932-0ec5-add0-2c7294cf80c3-e08abbc6 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-row-align: start;
  align-self: start;
}

#w-node-_260c6ab4-3932-0ec5-add0-2c7294cf80c6-e08abbc6 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_260c6ab4-3932-0ec5-add0-2c7294cf80c7-e08abbc6 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_260c6ab4-3932-0ec5-add0-2c7294cf80c8-e08abbc6 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-row-align: start;
  align-self: start;
}

#w-node-_260c6ab4-3932-0ec5-add0-2c7294cf80cb-e08abbc6 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_260c6ab4-3932-0ec5-add0-2c7294cf80cc-e08abbc6 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_260c6ab4-3932-0ec5-add0-2c7294cf80cd-e08abbc6 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-row-align: start;
  align-self: start;
}

#w-node-_260c6ab4-3932-0ec5-add0-2c7294cf80d0-e08abbc6 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_260c6ab4-3932-0ec5-add0-2c7294cf80d9-e08abbc6 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-row-align: start;
  align-self: start;
}

#w-node-_260c6ab4-3932-0ec5-add0-2c7294cf80db-e08abbc6 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
  -ms-grid-row-align: auto;
  align-self: auto;
}

#w-node-_260c6ab4-3932-0ec5-add0-2c7294cf80e6-e08abbc6 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

#w-node-_260c6ab4-3932-0ec5-add0-2c7294cf80e8-e08abbc6 {
  -ms-grid-column: span 1;
  grid-column-start: span 1;
  -ms-grid-column-span: 1;
  grid-column-end: span 1;
  -ms-grid-row: span 1;
  grid-row-start: span 1;
  -ms-grid-row-span: 1;
  grid-row-end: span 1;
}

@media screen and (min-width: 1440px) {
  #w-node-_9e9371a0-3648-c36d-a727-155e7f822178-6ba7dd61 {
    -ms-grid-column: span 1;
    grid-column-start: span 1;
    -ms-grid-column-span: 1;
    grid-column-end: span 1;
    -ms-grid-row: span 1;
    grid-row-start: span 1;
    -ms-grid-row-span: 1;
    grid-row-end: span 1;
  }

  #w-node-ff11b908-8c99-6516-9a7b-64951d0286f4-6ba7dd61 {
    -ms-grid-column: span 1;
    grid-column-start: span 1;
    -ms-grid-column-span: 1;
    grid-column-end: span 1;
    -ms-grid-row: span 1;
    grid-row-start: span 1;
    -ms-grid-row-span: 1;
    grid-row-end: span 1;
  }

  #w-node-dbcacc28-f4d9-7687-d9b0-c8593d7ad1b4-6ba7dd61 {
    -ms-grid-column: span 1;
    grid-column-start: span 1;
    -ms-grid-column-span: 1;
    grid-column-end: span 1;
    -ms-grid-row: span 1;
    grid-row-start: span 1;
    -ms-grid-row-span: 1;
    grid-row-end: span 1;
  }

  #w-node-ce36beea-55ad-afdf-2458-fe4fb6b9c62e-6ba7dd61 {
    -ms-grid-column: span 1;
    grid-column-start: span 1;
    -ms-grid-column-span: 1;
    grid-column-end: span 1;
    -ms-grid-row: span 1;
    grid-row-start: span 1;
    -ms-grid-row-span: 1;
    grid-row-end: span 1;
  }

  #w-node-_1fdb28d4-14cb-20c5-b379-37779d056e37-6ba7dd61 {
    -ms-grid-column: span 1;
    grid-column-start: span 1;
    -ms-grid-column-span: 1;
    grid-column-end: span 1;
    -ms-grid-row: span 1;
    grid-row-start: span 1;
    -ms-grid-row-span: 1;
    grid-row-end: span 1;
  }

  #w-node-_0269e8cf-cd87-91e9-e061-48d06b5685e5-6ba7dd61 {
    -ms-grid-column: span 1;
    grid-column-start: span 1;
    -ms-grid-column-span: 1;
    grid-column-end: span 1;
    -ms-grid-row: span 1;
    grid-row-start: span 1;
    -ms-grid-row-span: 1;
    grid-row-end: span 1;
  }
}

@media screen and (min-width: 1280px) {
  #w-node-c0194ae0-6f01-f412-c3f3-8c9e5a4976cb-b5a84b13 {
    -ms-grid-column-align: stretch;
    justify-self: stretch;
    -webkit-align-self: start;
    -ms-flex-item-align: start;
    -ms-grid-row-align: start;
    align-self: start;
  }

  #w-node-_84d9da0c-e34b-51fd-a7a7-36e66481dc71-b5a84b13 {
    -ms-grid-column-align: end;
    justify-self: end;
    -ms-grid-column: span 1;
    grid-column-start: span 1;
    -ms-grid-column-span: 1;
    grid-column-end: span 1;
    -ms-grid-row: span 1;
    grid-row-start: span 1;
    -ms-grid-row-span: 1;
    grid-row-end: span 1;
    -ms-grid-row-align: center;
    align-self: center;
  }

  #w-node-_39887752-2f57-3bb9-5533-f941c836ef7c-b5a84b13 {
    -ms-grid-column: span 1;
    grid-column-start: span 1;
    -ms-grid-column-span: 1;
    grid-column-end: span 1;
    -ms-grid-row: span 1;
    grid-row-start: span 1;
    -ms-grid-row-span: 1;
    grid-row-end: span 1;
  }

  #w-node-_37b0321c-68c3-ad18-15ee-d00480dbb00d-2ef08568 {
    -ms-grid-column-align: end;
    justify-self: end;
    -ms-grid-column: span 1;
    grid-column-start: span 1;
    -ms-grid-column-span: 1;
    grid-column-end: span 1;
    -ms-grid-row: span 1;
    grid-row-start: span 1;
    -ms-grid-row-span: 1;
    grid-row-end: span 1;
    -ms-grid-row-align: center;
    align-self: center;
  }
}
@font-face {
  font-family: 'webflow-icons';
  src: url("data:application/x-font-ttf;charset=utf-8;base64,AAEAAAALAIAAAwAwT1MvMg8SBiUAAAC8AAAAYGNtYXDpP+a4AAABHAAAAFxnYXNwAAAAEAAAAXgAAAAIZ2x5ZmhS2XEAAAGAAAADHGhlYWQTFw3HAAAEnAAAADZoaGVhCXYFgQAABNQAAAAkaG10eCe4A1oAAAT4AAAAMGxvY2EDtALGAAAFKAAAABptYXhwABAAPgAABUQAAAAgbmFtZSoCsMsAAAVkAAABznBvc3QAAwAAAAAHNAAAACAAAwP4AZAABQAAApkCzAAAAI8CmQLMAAAB6wAzAQkAAAAAAAAAAAAAAAAAAAABEAAAAAAAAAAAAAAAAAAAAABAAADpAwPA/8AAQAPAAEAAAAABAAAAAAAAAAAAAAAgAAAAAAADAAAAAwAAABwAAQADAAAAHAADAAEAAAAcAAQAQAAAAAwACAACAAQAAQAg5gPpA//9//8AAAAAACDmAOkA//3//wAB/+MaBBcIAAMAAQAAAAAAAAAAAAAAAAABAAH//wAPAAEAAAAAAAAAAAACAAA3OQEAAAAAAQAAAAAAAAAAAAIAADc5AQAAAAABAAAAAAAAAAAAAgAANzkBAAAAAAEBIAAAAyADgAAFAAAJAQcJARcDIP5AQAGA/oBAAcABwED+gP6AQAABAOAAAALgA4AABQAAEwEXCQEH4AHAQP6AAYBAAcABwED+gP6AQAAAAwDAAOADQALAAA8AHwAvAAABISIGHQEUFjMhMjY9ATQmByEiBh0BFBYzITI2PQE0JgchIgYdARQWMyEyNj0BNCYDIP3ADRMTDQJADRMTDf3ADRMTDQJADRMTDf3ADRMTDQJADRMTAsATDSANExMNIA0TwBMNIA0TEw0gDRPAEw0gDRMTDSANEwAAAAABAJ0AtAOBApUABQAACQIHCQEDJP7r/upcAXEBcgKU/usBFVz+fAGEAAAAAAL//f+9BAMDwwAEAAkAABcBJwEXAwE3AQdpA5ps/GZsbAOabPxmbEMDmmz8ZmwDmvxmbAOabAAAAgAA/8AEAAPAAB0AOwAABSInLgEnJjU0Nz4BNzYzMTIXHgEXFhUUBw4BBwYjNTI3PgE3NjU0Jy4BJyYjMSIHDgEHBhUUFx4BFxYzAgBqXV6LKCgoKIteXWpqXV6LKCgoKIteXWpVSktvICEhIG9LSlVVSktvICEhIG9LSlVAKCiLXl1qal1eiygoKCiLXl1qal1eiygoZiEgb0tKVVVKS28gISEgb0tKVVVKS28gIQABAAABwAIAA8AAEgAAEzQ3PgE3NjMxFSIHDgEHBhUxIwAoKIteXWpVSktvICFmAcBqXV6LKChmISBvS0pVAAAAAgAA/8AFtgPAADIAOgAAARYXHgEXFhUUBw4BBwYHIxUhIicuAScmNTQ3PgE3NjMxOAExNDc+ATc2MzIXHgEXFhcVATMJATMVMzUEjD83NlAXFxYXTjU1PQL8kz01Nk8XFxcXTzY1PSIjd1BQWlJJSXInJw3+mdv+2/7c25MCUQYcHFg5OUA/ODlXHBwIAhcXTzY1PTw1Nk8XF1tQUHcjIhwcYUNDTgL+3QFt/pOTkwABAAAAAQAAmM7nP18PPPUACwQAAAAAANciZKUAAAAA1yJkpf/9/70FtgPDAAAACAACAAAAAAAAAAEAAAPA/8AAAAW3//3//QW2AAEAAAAAAAAAAAAAAAAAAAAMBAAAAAAAAAAAAAAAAgAAAAQAASAEAADgBAAAwAQAAJ0EAP/9BAAAAAQAAAAFtwAAAAAAAAAKABQAHgAyAEYAjACiAL4BFgE2AY4AAAABAAAADAA8AAMAAAAAAAIAAAAAAAAAAAAAAAAAAAAAAAAADgCuAAEAAAAAAAEADQAAAAEAAAAAAAIABwCWAAEAAAAAAAMADQBIAAEAAAAAAAQADQCrAAEAAAAAAAUACwAnAAEAAAAAAAYADQBvAAEAAAAAAAoAGgDSAAMAAQQJAAEAGgANAAMAAQQJAAIADgCdAAMAAQQJAAMAGgBVAAMAAQQJAAQAGgC4AAMAAQQJAAUAFgAyAAMAAQQJAAYAGgB8AAMAAQQJAAoANADsd2ViZmxvdy1pY29ucwB3AGUAYgBmAGwAbwB3AC0AaQBjAG8AbgBzVmVyc2lvbiAxLjAAVgBlAHIAcwBpAG8AbgAgADEALgAwd2ViZmxvdy1pY29ucwB3AGUAYgBmAGwAbwB3AC0AaQBjAG8AbgBzd2ViZmxvdy1pY29ucwB3AGUAYgBmAGwAbwB3AC0AaQBjAG8AbgBzUmVndWxhcgBSAGUAZwB1AGwAYQByd2ViZmxvdy1pY29ucwB3AGUAYgBmAGwAbwB3AC0AaQBjAG8AbgBzRm9udCBnZW5lcmF0ZWQgYnkgSWNvTW9vbi4ARgBvAG4AdAAgAGcAZQBuAGUAcgBhAHQAZQBkACAAYgB5ACAASQBjAG8ATQBvAG8AbgAuAAAAAwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA==") format('truetype');
  font-weight: normal;
  font-style: normal;
}
[class^="w-icon-"],
[class*=" w-icon-"] {
  /* use !important to prevent issues with browser extensions that change fonts */
  font-family: 'webflow-icons' !important;
  speak: none;
  font-style: normal;
  font-weight: normal;
  font-variant: normal;
  text-transform: none;
  line-height: 1;
  /* Better Font Rendering =========== */
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
.w-icon-slider-right:before {
  content: "\e600";
}
.w-icon-slider-left:before {
  content: "\e601";
}
.w-icon-nav-menu:before {
  content: "\e602";
}
.w-icon-arrow-down:before,
.w-icon-dropdown-toggle:before {
  content: "\e603";
}
.w-icon-file-upload-remove:before {
  content: "\e900";
}
.w-icon-file-upload-icon:before {
  content: "\e903";
}
* {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}
html {
  height: 100%;
}
body {
  margin: 0;
  min-height: 100%;
  background-color: #fff;
  font-family: Arial, sans-serif;
  font-size: 14px;
  line-height: 20px;
  color: #333;
}
img {
  max-width: 100%;
  vertical-align: middle;
  display: inline-block;
}
html.w-mod-touch * {
  background-attachment: scroll !important;
}
.w-block {
  display: block;
}
.w-inline-block {
  max-width: 100%;
  display: inline-block;
}
.w-clearfix:before,
.w-clearfix:after {
  content: " ";
  display: table;
  grid-column-start: 1;
  grid-row-start: 1;
  grid-column-end: 2;
  grid-row-end: 2;
}
.w-clearfix:after {
  clear: both;
}
.w-hidden {
  display: none;
}
.w-button {
  display: inline-block;
  padding: 9px 15px;
  background-color: #3898EC;
  color: white;
  border: 0;
  line-height: inherit;
  text-decoration: none;
  cursor: pointer;
  border-radius: 0;
}
input.w-button {
  -webkit-appearance: button;
}
html[data-w-dynpage] [data-w-cloak] {
  color: transparent !important;
}
.w-webflow-badge,
.w-webflow-badge * {
  position: static;
  left: auto;
  top: auto;
  right: auto;
  bottom: auto;
  z-index: auto;
  display: block;
  visibility: visible;
  overflow: visible;
  overflow-x: visible;
  overflow-y: visible;
  box-sizing: border-box;
  width: auto;
  height: auto;
  max-height: none;
  max-width: none;
  min-height: 0;
  min-width: 0;
  margin: 0;
  padding: 0;
  float: none;
  clear: none;
  border: 0 none transparent;
  border-radius: 0;
  background: none;
  background-image: none;
  background-position: 0% 0%;
  background-size: auto auto;
  background-repeat: repeat;
  background-origin: padding-box;
  background-clip: border-box;
  background-attachment: scroll;
  background-color: transparent;
  box-shadow: none;
  opacity: 1;
  transform: none;
  transition: none;
  direction: ltr;
  font-family: inherit;
  font-weight: inherit;
  color: inherit;
  font-size: inherit;
  line-height: inherit;
  font-style: inherit;
  font-variant: inherit;
  text-align: inherit;
  letter-spacing: inherit;
  text-decoration: inherit;
  text-indent: 0;
  text-transform: inherit;
  list-style-type: disc;
  text-shadow: none;
  font-smoothing: auto;
  vertical-align: baseline;
  cursor: inherit;
  white-space: inherit;
  word-break: normal;
  word-spacing: normal;
  word-wrap: normal;
}
.w-webflow-badge {
  position: fixed !important;
  display: inline-block !important;
  visibility: visible !important;
  z-index: 2147483647 !important;
  top: auto !important;
  right: 12px !important;
  bottom: 12px !important;
  left: auto !important;
  color: #AAADB0 !important;
  background-color: #fff !important;
  border-radius: 3px !important;
  padding: 6px 8px 6px 6px !important;
  font-size: 12px !important;
  opacity: 1 !important;
  line-height: 14px !important;
  text-decoration: none !important;
  transform: none !important;
  margin: 0 !important;
  width: auto !important;
  height: auto !important;
  overflow: visible !important;
  white-space: nowrap;
  box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.1), 0px 1px 3px rgba(0, 0, 0, 0.1);
  cursor: pointer;
}
.w-webflow-badge > img {
  display: inline-block !important;
  visibility: visible !important;
  opacity: 1 !important;
  vertical-align: middle !important;
}
h1,
h2,
h3,
h4,
h5,
h6 {
  font-weight: bold;
  margin-bottom: 10px;
}
h1 {
  font-size: 38px;
  line-height: 44px;
  margin-top: 20px;
}
h2 {
  font-size: 32px;
  line-height: 36px;
  margin-top: 20px;
}
h3 {
  font-size: 24px;
  line-height: 30px;
  margin-top: 20px;
}
h4 {
  font-size: 18px;
  line-height: 24px;
  margin-top: 10px;
}
h5 {
  font-size: 14px;
  line-height: 20px;
  margin-top: 10px;
}
h6 {
  font-size: 12px;
  line-height: 18px;
  margin-top: 10px;
}
p {
  margin-top: 0;
  margin-bottom: 10px;
}
blockquote {
  margin: 0 0 10px 0;
  padding: 10px 20px;
  border-left: 5px solid #E2E2E2;
  font-size: 18px;
  line-height: 22px;
}
figure {
  margin: 0;
  margin-bottom: 10px;
}
figcaption {
  margin-top: 5px;
  text-align: center;
}
ul,
ol {
  margin-top: 0px;
  margin-bottom: 10px;
  padding-left: 40px;
}
.w-list-unstyled {
  padding-left: 0;
  list-style: none;
}
.w-embed:before,
.w-embed:after {
  content: " ";
  display: table;
  grid-column-start: 1;
  grid-row-start: 1;
  grid-column-end: 2;
  grid-row-end: 2;
}
.w-embed:after {
  clear: both;
}
.w-video {
  width: 100%;
  position: relative;
  padding: 0;
}
.w-video iframe,
.w-video object,
.w-video embed {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  border: none;
}
fieldset {
  padding: 0;
  margin: 0;
  border: 0;
}
button,
[type='button'],
[type='reset'] {
  border: 0;
  cursor: pointer;
  -webkit-appearance: button;
}
.w-form {
  margin: 0 0 15px;
}
.w-form-done {
  display: none;
  padding: 20px;
  text-align: center;
  background-color: #dddddd;
}
.w-form-fail {
  display: none;
  margin-top: 10px;
  padding: 10px;
  background-color: #ffdede;
}
label {
  display: block;
  margin-bottom: 5px;
  font-weight: bold;
}
.w-input,
.w-select {
  display: block;
  width: 100%;
  height: 38px;
  padding: 8px 12px;
  margin-bottom: 10px;
  font-size: 14px;
  line-height: 1.42857143;
  color: #333333;
  vertical-align: middle;
  background-color: #ffffff;
  border: 1px solid #cccccc;
}
.w-input:-moz-placeholder,
.w-select:-moz-placeholder {
  color: #999;
}
.w-input::-moz-placeholder,
.w-select::-moz-placeholder {
  color: #999;
  opacity: 1;
}
.w-input:-ms-input-placeholder,
.w-select:-ms-input-placeholder {
  color: #999;
}
.w-input::-webkit-input-placeholder,
.w-select::-webkit-input-placeholder {
  color: #999;
}
.w-input:focus,
.w-select:focus {
  border-color: #3898EC;
  outline: 0;
}
.w-input[disabled],
.w-select[disabled],
.w-input[readonly],
.w-select[readonly],
fieldset[disabled] .w-input,
fieldset[disabled] .w-select {
  cursor: not-allowed;
}
.w-input[disabled]:not(.w-input-disabled),
.w-select[disabled]:not(.w-input-disabled),
.w-input[readonly],
.w-select[readonly],
fieldset[disabled]:not(.w-input-disabled) .w-input,
fieldset[disabled]:not(.w-input-disabled) .w-select {
  background-color: #eeeeee;
}
textarea.w-input,
textarea.w-select {
  height: auto;
}
.w-select {
  background-color: #f3f3f3;
}
.w-select[multiple] {
  height: auto;
}
.w-form-label {
  display: inline-block;
  cursor: pointer;
  font-weight: normal;
  margin-bottom: 0px;
}
.w-radio {
  display: block;
  margin-bottom: 5px;
  padding-left: 20px;
}
.w-radio:before,
.w-radio:after {
  content: " ";
  display: table;
  grid-column-start: 1;
  grid-row-start: 1;
  grid-column-end: 2;
  grid-row-end: 2;
}
.w-radio:after {
  clear: both;
}
.w-radio-input {
  margin: 4px 0 0;
  margin-top: 1px \9;
  line-height: normal;
  float: left;
  margin-left: -20px;
}
.w-radio-input {
  margin-top: 3px;
}
.w-file-upload {
  display: block;
  margin-bottom: 10px;
}
.w-file-upload-input {
  width: 0.1px;
  height: 0.1px;
  opacity: 0;
  overflow: hidden;
  position: absolute;
  z-index: -100;
}
.w-file-upload-default,
.w-file-upload-uploading,
.w-file-upload-success {
  display: inline-block;
  color: #333333;
}
.w-file-upload-error {
  display: block;
  margin-top: 10px;
}
.w-file-upload-default.w-hidden,
.w-file-upload-uploading.w-hidden,
.w-file-upload-error.w-hidden,
.w-file-upload-success.w-hidden {
  display: none;
}
.w-file-upload-uploading-btn {
  display: flex;
  font-size: 14px;
  font-weight: normal;
  cursor: pointer;
  margin: 0;
  padding: 8px 12px;
  border: 1px solid #cccccc;
  background-color: #fafafa;
}
.w-file-upload-file {
  display: flex;
  flex-grow: 1;
  justify-content: space-between;
  margin: 0;
  padding: 8px 9px 8px 11px;
  border: 1px solid #cccccc;
  background-color: #fafafa;
}
.w-file-upload-file-name {
  font-size: 14px;
  font-weight: normal;
  display: block;
}
.w-file-remove-link {
  margin-top: 3px;
  margin-left: 10px;
  width: auto;
  height: auto;
  padding: 3px;
  display: block;
  cursor: pointer;
}
.w-icon-file-upload-remove {
  margin: auto;
  font-size: 10px;
}
.w-file-upload-error-msg {
  display: inline-block;
  color: #ea384c;
  padding: 2px 0;
}
.w-file-upload-info {
  display: inline-block;
  line-height: 38px;
  padding: 0 12px;
}
.w-file-upload-label {
  display: inline-block;
  font-size: 14px;
  font-weight: normal;
  cursor: pointer;
  margin: 0;
  padding: 8px 12px;
  border: 1px solid #cccccc;
  background-color: #fafafa;
}
.w-icon-file-upload-icon,
.w-icon-file-upload-uploading {
  display: inline-block;
  margin-right: 8px;
  width: 20px;
}
.w-icon-file-upload-uploading {
  height: 20px;
}
.w-container {
  margin-left: auto;
  margin-right: auto;
  max-width: 940px;
}
.w-container:before,
.w-container:after {
  content: " ";
  display: table;
  grid-column-start: 1;
  grid-row-start: 1;
  grid-column-end: 2;
  grid-row-end: 2;
}
.w-container:after {
  clear: both;
}
.w-container .w-row {
  margin-left: -10px;
  margin-right: -10px;
}
.w-row:before,
.w-row:after {
  content: " ";
  display: table;
  grid-column-start: 1;
  grid-row-start: 1;
  grid-column-end: 2;
  grid-row-end: 2;
}
.w-row:after {
  clear: both;
}
.w-row .w-row {
  margin-left: 0;
  margin-right: 0;
}
.w-col {
  position: relative;
  float: left;
  width: 100%;
  min-height: 1px;
  padding-left: 10px;
  padding-right: 10px;
}
.w-col .w-col {
  padding-left: 0;
  padding-right: 0;
}
.w-col-1 {
  width: 8.33333333%;
}
.w-col-2 {
  width: 16.66666667%;
}
.w-col-3 {
  width: 25%;
}
.w-col-4 {
  width: 33.33333333%;
}
.w-col-5 {
  width: 41.66666667%;
}
.w-col-6 {
  width: 50%;
}
.w-col-7 {
  width: 58.33333333%;
}
.w-col-8 {
  width: 66.66666667%;
}
.w-col-9 {
  width: 75%;
}
.w-col-10 {
  width: 83.33333333%;
}
.w-col-11 {
  width: 91.66666667%;
}
.w-col-12 {
  width: 100%;
}
.w-hidden-main {
  display: none !important;
}
@media screen and (max-width: 991px) {
  .w-container {
    max-width: 728px;
  }
  .w-hidden-main {
    display: inherit !important;
  }
  .w-hidden-medium {
    display: none !important;
  }
  .w-col-medium-1 {
    width: 8.33333333%;
  }
  .w-col-medium-2 {
    width: 16.66666667%;
  }
  .w-col-medium-3 {
    width: 25%;
  }
  .w-col-medium-4 {
    width: 33.33333333%;
  }
  .w-col-medium-5 {
    width: 41.66666667%;
  }
  .w-col-medium-6 {
    width: 50%;
  }
  .w-col-medium-7 {
    width: 58.33333333%;
  }
  .w-col-medium-8 {
    width: 66.66666667%;
  }
  .w-col-medium-9 {
    width: 75%;
  }
  .w-col-medium-10 {
    width: 83.33333333%;
  }
  .w-col-medium-11 {
    width: 91.66666667%;
  }
  .w-col-medium-12 {
    width: 100%;
  }
  .w-col-stack {
    width: 100%;
    left: auto;
    right: auto;
  }
}
@media screen and (max-width: 767px) {
  .w-hidden-main {
    display: inherit !important;
  }
  .w-hidden-medium {
    display: inherit !important;
  }
  .w-hidden-small {
    display: none !important;
  }
  .w-row,
  .w-container .w-row {
    margin-left: 0;
    margin-right: 0;
  }
  .w-col {
    width: 100%;
    left: auto;
    right: auto;
  }
  .w-col-small-1 {
    width: 8.33333333%;
  }
  .w-col-small-2 {
    width: 16.66666667%;
  }
  .w-col-small-3 {
    width: 25%;
  }
  .w-col-small-4 {
    width: 33.33333333%;
  }
  .w-col-small-5 {
    width: 41.66666667%;
  }
  .w-col-small-6 {
    width: 50%;
  }
  .w-col-small-7 {
    width: 58.33333333%;
  }
  .w-col-small-8 {
    width: 66.66666667%;
  }
  .w-col-small-9 {
    width: 75%;
  }
  .w-col-small-10 {
    width: 83.33333333%;
  }
  .w-col-small-11 {
    width: 91.66666667%;
  }
  .w-col-small-12 {
    width: 100%;
  }
}
@media screen and (max-width: 479px) {
  .w-container {
    max-width: none;
  }
  .w-hidden-main {
    display: inherit !important;
  }
  .w-hidden-medium {
    display: inherit !important;
  }
  .w-hidden-small {
    display: inherit !important;
  }
  .w-hidden-tiny {
    display: none !important;
  }
  .w-col {
    width: 100%;
  }
  .w-col-tiny-1 {
    width: 8.33333333%;
  }
  .w-col-tiny-2 {
    width: 16.66666667%;
  }
  .w-col-tiny-3 {
    width: 25%;
  }
  .w-col-tiny-4 {
    width: 33.33333333%;
  }
  .w-col-tiny-5 {
    width: 41.66666667%;
  }
  .w-col-tiny-6 {
    width: 50%;
  }
  .w-col-tiny-7 {
    width: 58.33333333%;
  }
  .w-col-tiny-8 {
    width: 66.66666667%;
  }
  .w-col-tiny-9 {
    width: 75%;
  }
  .w-col-tiny-10 {
    width: 83.33333333%;
  }
  .w-col-tiny-11 {
    width: 91.66666667%;
  }
  .w-col-tiny-12 {
    width: 100%;
  }
}
.w-widget {
  position: relative;
}
.w-widget-map {
  width: 100%;
  height: 400px;
}
.w-widget-map label {
  width: auto;
  display: inline;
}
.w-widget-map img {
  max-width: inherit;
}
.w-widget-map .gm-style-iw {
  text-align: center;
}
.w-widget-map .gm-style-iw > button {
  display: none !important;
}
.w-widget-twitter {
  overflow: hidden;
}
.w-widget-twitter-count-shim {
  display: inline-block;
  vertical-align: top;
  position: relative;
  width: 28px;
  height: 20px;
  text-align: center;
  background: white;
  border: #758696 solid 1px;
  border-radius: 3px;
}
.w-widget-twitter-count-shim * {
  pointer-events: none;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}
.w-widget-twitter-count-shim .w-widget-twitter-count-inner {
  position: relative;
  font-size: 15px;
  line-height: 12px;
  text-align: center;
  color: #999;
  font-family: serif;
}
.w-widget-twitter-count-shim .w-widget-twitter-count-clear {
  position: relative;
  display: block;
}
.w-widget-twitter-count-shim.w--large {
  width: 36px;
  height: 28px;
}
.w-widget-twitter-count-shim.w--large .w-widget-twitter-count-inner {
  font-size: 18px;
  line-height: 18px;
}
.w-widget-twitter-count-shim:not(.w--vertical) {
  margin-left: 5px;
  margin-right: 8px;
}
.w-widget-twitter-count-shim:not(.w--vertical).w--large {
  margin-left: 6px;
}
.w-widget-twitter-count-shim:not(.w--vertical):before,
.w-widget-twitter-count-shim:not(.w--vertical):after {
  top: 50%;
  left: 0;
  border: solid transparent;
  content: ' ';
  height: 0;
  width: 0;
  position: absolute;
  pointer-events: none;
}
.w-widget-twitter-count-shim:not(.w--vertical):before {
  border-color: rgba(117, 134, 150, 0);
  border-right-color: #5d6c7b;
  border-width: 4px;
  margin-left: -9px;
  margin-top: -4px;
}
.w-widget-twitter-count-shim:not(.w--vertical).w--large:before {
  border-width: 5px;
  margin-left: -10px;
  margin-top: -5px;
}
.w-widget-twitter-count-shim:not(.w--vertical):after {
  border-color: rgba(255, 255, 255, 0);
  border-right-color: white;
  border-width: 4px;
  margin-left: -8px;
  margin-top: -4px;
}
.w-widget-twitter-count-shim:not(.w--vertical).w--large:after {
  border-width: 5px;
  margin-left: -9px;
  margin-top: -5px;
}
.w-widget-twitter-count-shim.w--vertical {
  width: 61px;
  height: 33px;
  margin-bottom: 8px;
}
.w-widget-twitter-count-shim.w--vertical:before,
.w-widget-twitter-count-shim.w--vertical:after {
  top: 100%;
  left: 50%;
  border: solid transparent;
  content: ' ';
  height: 0;
  width: 0;
  position: absolute;
  pointer-events: none;
}
.w-widget-twitter-count-shim.w--vertical:before {
  border-color: rgba(117, 134, 150, 0);
  border-top-color: #5d6c7b;
  border-width: 5px;
  margin-left: -5px;
}
.w-widget-twitter-count-shim.w--vertical:after {
  border-color: rgba(255, 255, 255, 0);
  border-top-color: white;
  border-width: 4px;
  margin-left: -4px;
}
.w-widget-twitter-count-shim.w--vertical .w-widget-twitter-count-inner {
  font-size: 18px;
  line-height: 22px;
}
.w-widget-twitter-count-shim.w--vertical.w--large {
  width: 76px;
}
.w-background-video {
  position: relative;
  overflow: hidden;
  height: 500px;
  color: white;
}
.w-background-video > video {
  background-size: cover;
  background-position: 50% 50%;
  position: absolute;
  margin: auto;
  width: 100%;
  height: 100%;
  right: -100%;
  bottom: -100%;
  top: -100%;
  left: -100%;
  object-fit: cover;
  z-index: -100;
}
.w-background-video > video::-webkit-media-controls-start-playback-button {
  display: none !important;
  -webkit-appearance: none;
}
.w-background-video--control {
  position: absolute;
  bottom: 1em;
  right: 1em;
  background-color: transparent;
  padding: 0;
}
.w-background-video--control > [hidden] {
  display: none !important;
}
.w-slider {
  position: relative;
  height: 300px;
  text-align: center;
  background: #dddddd;
  clear: both;
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
  tap-highlight-color: rgba(0, 0, 0, 0);
}
.w-slider-mask {
  position: relative;
  display: block;
  overflow: hidden;
  z-index: 1;
  left: 0;
  right: 0;
  height: 100%;
  white-space: nowrap;
}
.w-slide {
  position: relative;
  display: inline-block;
  vertical-align: top;
  width: 100%;
  height: 100%;
  white-space: normal;
  text-align: left;
}
.w-slider-nav {
  position: absolute;
  z-index: 2;
  top: auto;
  right: 0;
  bottom: 0;
  left: 0;
  margin: auto;
  padding-top: 10px;
  height: 40px;
  text-align: center;
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
  tap-highlight-color: rgba(0, 0, 0, 0);
}
.w-slider-nav.w-round > div {
  border-radius: 100%;
}
.w-slider-nav.w-num > div {
  width: auto;
  height: auto;
  padding: 0.2em 0.5em;
  font-size: inherit;
  line-height: inherit;
}
.w-slider-nav.w-shadow > div {
  box-shadow: 0 0 3px rgba(51, 51, 51, 0.4);
}
.w-slider-nav-invert {
  color: #fff;
}
.w-slider-nav-invert > div {
  background-color: rgba(34, 34, 34, 0.4);
}
.w-slider-nav-invert > div.w-active {
  background-color: #222;
}
.w-slider-dot {
  position: relative;
  display: inline-block;
  width: 1em;
  height: 1em;
  background-color: rgba(255, 255, 255, 0.4);
  cursor: pointer;
  margin: 0 3px 0.5em;
  transition: background-color 100ms, color 100ms;
}
.w-slider-dot.w-active {
  background-color: #fff;
}
.w-slider-dot:focus {
  outline: none;
  box-shadow: 0px 0px 0px 2px #fff;
}
.w-slider-dot:focus.w-active {
  box-shadow: none;
}
.w-slider-arrow-left,
.w-slider-arrow-right {
  position: absolute;
  width: 80px;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  margin: auto;
  cursor: pointer;
  overflow: hidden;
  color: white;
  font-size: 40px;
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
  tap-highlight-color: rgba(0, 0, 0, 0);
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}
.w-slider-arrow-left [class^='w-icon-'],
.w-slider-arrow-right [class^='w-icon-'],
.w-slider-arrow-left [class*=' w-icon-'],
.w-slider-arrow-right [class*=' w-icon-'] {
  position: absolute;
}
.w-slider-arrow-left:focus,
.w-slider-arrow-right:focus {
  outline: 0;
}
.w-slider-arrow-left {
  z-index: 3;
  right: auto;
}
.w-slider-arrow-right {
  z-index: 4;
  left: auto;
}
.w-icon-slider-left,
.w-icon-slider-right {
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  margin: auto;
  width: 1em;
  height: 1em;
}
.w-slider-aria-label {
  border: 0;
  clip: rect(0 0 0 0);
  height: 1px;
  margin: -1px;
  overflow: hidden;
  padding: 0;
  position: absolute;
  width: 1px;
}
.w-slider-force-show {
  display: block !important;
}
.w-dropdown {
  display: inline-block;
  position: relative;
  text-align: left;
  margin-left: auto;
  margin-right: auto;
  z-index: 900;
}
.w-dropdown-btn,
.w-dropdown-toggle,
.w-dropdown-link {
  position: relative;
  vertical-align: top;
  text-decoration: none;
  color: #222222;
  padding: 20px;
  text-align: left;
  margin-left: auto;
  margin-right: auto;
  white-space: nowrap;
}
.w-dropdown-toggle {
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  display: inline-block;
  cursor: pointer;
  padding-right: 40px;
}
.w-dropdown-toggle:focus {
  outline: 0;
}
.w-icon-dropdown-toggle {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  margin: auto;
  margin-right: 20px;
  width: 1em;
  height: 1em;
}
.w-dropdown-list {
  position: absolute;
  background: #dddddd;
  display: none;
  min-width: 100%;
}
.w-dropdown-list.w--open {
  display: block;
}
.w-dropdown-link {
  padding: 10px 20px;
  display: block;
  color: #222222;
}
.w-dropdown-link.w--current {
  color: #0082f3;
}
.w-dropdown-link:focus {
  outline: 0;
}
@media screen and (max-width: 767px) {
  .w-nav-brand {
    padding-left: 10px;
  }
}
/**
 * ## Note
 * Safari (on both iOS and OS X) does not handle viewport units (vh, vw) well.
 * For example percentage units do not work on descendants of elements that
 * have any dimensions expressed in viewport units. It also doesn’t handle them at
 * all in `calc()`.
 */
/**
 * Wrapper around all lightbox elements
 *
 * 1. Since the lightbox can receive focus, IE also gives it an outline.
 * 2. Fixes flickering on Chrome when a transition is in progress
 *    underneath the lightbox.
 */
.w-lightbox-backdrop {
  color: #000;
  cursor: auto;
  font-family: serif;
  font-size: medium;
  font-style: normal;
  font-variant: normal;
  font-weight: normal;
  letter-spacing: normal;
  line-height: normal;
  list-style: disc;
  text-align: start;
  text-indent: 0;
  text-shadow: none;
  text-transform: none;
  visibility: visible;
  white-space: normal;
  word-break: normal;
  word-spacing: normal;
  word-wrap: normal;
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  color: #fff;
  font-family: "Helvetica Neue", Helvetica, Ubuntu, "Segoe UI", Verdana, sans-serif;
  font-size: 17px;
  line-height: 1.2;
  font-weight: 300;
  text-align: center;
  background: rgba(0, 0, 0, 0.9);
  z-index: 2000;
  outline: 0;
  /* 1 */
  opacity: 0;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  -webkit-tap-highlight-color: transparent;
  -webkit-transform: translate(0, 0);
  /* 2 */
}
/**
 * Neat trick to bind the rubberband effect to our canvas instead of the whole
 * document on iOS. It also prevents a bug that causes the document underneath to scroll.
 */
.w-lightbox-backdrop,
.w-lightbox-container {
  height: 100%;
  overflow: auto;
  -webkit-overflow-scrolling: touch;
}
.w-lightbox-content {
  position: relative;
  height: 100vh;
  overflow: hidden;
}
.w-lightbox-view {
  position: absolute;
  width: 100vw;
  height: 100vh;
  opacity: 0;
}
.w-lightbox-view:before {
  content: "";
  height: 100vh;
}
/* .w-lightbox-content */
.w-lightbox-group,
.w-lightbox-group .w-lightbox-view,
.w-lightbox-group .w-lightbox-view:before {
  height: 86vh;
}
.w-lightbox-frame,
.w-lightbox-view:before {
  display: inline-block;
  vertical-align: middle;
}
/*
 * 1. Remove default margin set by user-agent on the <figure> element.
 */
.w-lightbox-figure {
  position: relative;
  margin: 0;
  /* 1 */
}
.w-lightbox-group .w-lightbox-figure {
  cursor: pointer;
}
/**
 * IE adds image dimensions as width and height attributes on the IMG tag,
 * but we need both width and height to be set to auto to enable scaling.
 */
.w-lightbox-img {
  width: auto;
  height: auto;
  max-width: none;
}
/**
 * 1. Reset if style is set by user on "All Images"
 */
.w-lightbox-image {
  display: block;
  float: none;
  /* 1 */
  max-width: 100vw;
  max-height: 100vh;
}
.w-lightbox-group .w-lightbox-image {
  max-height: 86vh;
}
.w-lightbox-caption {
  position: absolute;
  right: 0;
  bottom: 0;
  left: 0;
  padding: 0.5em 1em;
  background: rgba(0, 0, 0, 0.4);
  text-align: left;
  text-overflow: ellipsis;
  white-space: nowrap;
  overflow: hidden;
}
.w-lightbox-embed {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 100%;
}
.w-lightbox-control {
  position: absolute;
  top: 0;
  width: 4em;
  background-size: 24px;
  background-repeat: no-repeat;
  background-position: center;
  cursor: pointer;
  -webkit-transition: all 0.3s;
  transition: all 0.3s;
}
.w-lightbox-left {
  display: none;
  bottom: 0;
  left: 0;
  /* <svg xmlns="http://www.w3.org/2000/svg" viewBox="-20 0 24 40" width="24" height="40"><g transform="rotate(45)"><path d="m0 0h5v23h23v5h-28z" opacity=".4"/><path d="m1 1h3v23h23v3h-26z" fill="#fff"/></g></svg> */
  background-image: url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9Ii0yMCAwIDI0IDQwIiB3aWR0aD0iMjQiIGhlaWdodD0iNDAiPjxnIHRyYW5zZm9ybT0icm90YXRlKDQ1KSI+PHBhdGggZD0ibTAgMGg1djIzaDIzdjVoLTI4eiIgb3BhY2l0eT0iLjQiLz48cGF0aCBkPSJtMSAxaDN2MjNoMjN2M2gtMjZ6IiBmaWxsPSIjZmZmIi8+PC9nPjwvc3ZnPg==");
}
.w-lightbox-right {
  display: none;
  right: 0;
  bottom: 0;
  /* <svg xmlns="http://www.w3.org/2000/svg" viewBox="-4 0 24 40" width="24" height="40"><g transform="rotate(45)"><path d="m0-0h28v28h-5v-23h-23z" opacity=".4"/><path d="m1 1h26v26h-3v-23h-23z" fill="#fff"/></g></svg> */
  background-image: url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9Ii00IDAgMjQgNDAiIHdpZHRoPSIyNCIgaGVpZ2h0PSI0MCI+PGcgdHJhbnNmb3JtPSJyb3RhdGUoNDUpIj48cGF0aCBkPSJtMC0waDI4djI4aC01di0yM2gtMjN6IiBvcGFjaXR5PSIuNCIvPjxwYXRoIGQ9Im0xIDFoMjZ2MjZoLTN2LTIzaC0yM3oiIGZpbGw9IiNmZmYiLz48L2c+PC9zdmc+");
}
/*
 * Without specifying the with and height inside the SVG, all versions of IE render the icon too small.
 * The bug does not seem to manifest itself if the elements are tall enough such as the above arrows.
 * (http://stackoverflow.com/questions/16092114/background-size-differs-in-internet-explorer)
 */
.w-lightbox-close {
  right: 0;
  height: 2.6em;
  /* <svg xmlns="http://www.w3.org/2000/svg" viewBox="-4 0 18 17" width="18" height="17"><g transform="rotate(45)"><path d="m0 0h7v-7h5v7h7v5h-7v7h-5v-7h-7z" opacity=".4"/><path d="m1 1h7v-7h3v7h7v3h-7v7h-3v-7h-7z" fill="#fff"/></g></svg> */
  background-image: url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9Ii00IDAgMTggMTciIHdpZHRoPSIxOCIgaGVpZ2h0PSIxNyI+PGcgdHJhbnNmb3JtPSJyb3RhdGUoNDUpIj48cGF0aCBkPSJtMCAwaDd2LTdoNXY3aDd2NWgtN3Y3aC01di03aC03eiIgb3BhY2l0eT0iLjQiLz48cGF0aCBkPSJtMSAxaDd2LTdoM3Y3aDd2M2gtN3Y3aC0zdi03aC03eiIgZmlsbD0iI2ZmZiIvPjwvZz48L3N2Zz4=");
  background-size: 18px;
}
/**
 * 1. All IE versions add extra space at the bottom without this.
 */
.w-lightbox-strip {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  padding: 0 1vh;
  line-height: 0;
  /* 1 */
  white-space: nowrap;
  overflow-x: auto;
  overflow-y: hidden;
}
/*
 * 1. We use content-box to avoid having to do `width: calc(10vh + 2vw)`
 *    which doesn’t work in Safari anyway.
 * 2. Chrome renders images pixelated when switching to GPU. Making sure
 *    the parent is also rendered on the GPU (by setting translate3d for
 *    example) fixes this behavior.
 */
.w-lightbox-item {
  display: inline-block;
  width: 10vh;
  padding: 2vh 1vh;
  box-sizing: content-box;
  /* 1 */
  cursor: pointer;
  -webkit-transform: translate3d(0, 0, 0);
  /* 2 */
}
.w-lightbox-active {
  opacity: 0.3;
}
.w-lightbox-thumbnail {
  position: relative;
  height: 10vh;
  background: #222;
  overflow: hidden;
}
.w-lightbox-thumbnail-image {
  position: absolute;
  top: 0;
  left: 0;
}
.w-lightbox-thumbnail .w-lightbox-tall {
  top: 50%;
  width: 100%;
  -webkit-transform: translate(0, -50%);
  -ms-transform: translate(0, -50%);
  transform: translate(0, -50%);
}
.w-lightbox-thumbnail .w-lightbox-wide {
  left: 50%;
  height: 100%;
  -webkit-transform: translate(-50%, 0);
  -ms-transform: translate(-50%, 0);
  transform: translate(-50%, 0);
}
/*
 * Spinner
 *
 * Absolute pixel values are used to avoid rounding errors that would cause
 * the white spinning element to be misaligned with the track.
 */
.w-lightbox-spinner {
  position: absolute;
  top: 50%;
  left: 50%;
  box-sizing: border-box;
  width: 40px;
  height: 40px;
  margin-top: -20px;
  margin-left: -20px;
  border: 5px solid rgba(0, 0, 0, 0.4);
  border-radius: 50%;
  -webkit-animation: spin 0.8s infinite linear;
  animation: spin 0.8s infinite linear;
}
.w-lightbox-spinner:after {
  content: "";
  position: absolute;
  top: -4px;
  right: -4px;
  bottom: -4px;
  left: -4px;
  border: 3px solid transparent;
  border-bottom-color: #fff;
  border-radius: 50%;
}
/*
 * Utility classes
 */
.w-lightbox-hide {
  display: none;
}
.w-lightbox-noscroll {
  overflow: hidden;
}
@media (min-width: 768px) {
  .w-lightbox-content {
    height: 96vh;
    margin-top: 2vh;
  }
  .w-lightbox-view,
  .w-lightbox-view:before {
    height: 96vh;
  }
  /* .w-lightbox-content */
  .w-lightbox-group,
  .w-lightbox-group .w-lightbox-view,
  .w-lightbox-group .w-lightbox-view:before {
    height: 84vh;
  }
  .w-lightbox-image {
    max-width: 96vw;
    max-height: 96vh;
  }
  .w-lightbox-group .w-lightbox-image {
    max-width: 82.3vw;
    max-height: 84vh;
  }
  .w-lightbox-left,
  .w-lightbox-right {
    display: block;
    opacity: 0.5;
  }
  .w-lightbox-close {
    opacity: 0.8;
  }
  .w-lightbox-control:hover {
    opacity: 1;
  }
}
.w-lightbox-inactive,
.w-lightbox-inactive:hover {
  opacity: 0;
}
.w-richtext:before,
.w-richtext:after {
  content: " ";
  display: table;
  grid-column-start: 1;
  grid-row-start: 1;
  grid-column-end: 2;
  grid-row-end: 2;
}
.w-richtext:after {
  clear: both;
}
.w-richtext[contenteditable="true"]:before,
.w-richtext[contenteditable="true"]:after {
  white-space: initial;
}
.w-richtext ol,
.w-richtext ul {
  overflow: hidden;
}
.w-richtext .w-richtext-figure-selected.w-richtext-figure-type-video div:after,
.w-richtext .w-richtext-figure-selected[data-rt-type="video"] div:after {
  outline: 2px solid #2895f7;
}
.w-richtext .w-richtext-figure-selected.w-richtext-figure-type-image div,
.w-richtext .w-richtext-figure-selected[data-rt-type="image"] div {
  outline: 2px solid #2895f7;
}
.w-richtext figure.w-richtext-figure-type-video > div:after,
.w-richtext figure[data-rt-type="video"] > div:after {
  content: '';
  position: absolute;
  display: none;
  left: 0;
  top: 0;
  right: 0;
  bottom: 0;
}
.w-richtext figure {
  position: relative;
  max-width: 60%;
}
.w-richtext figure > div:before {
  cursor: default!important;
}
.w-richtext figure img {
  width: 100%;
}
.w-richtext figure figcaption.w-richtext-figcaption-placeholder {
  opacity: 0.6;
}
.w-richtext figure div {
  /* fix incorrectly sized selection border in the data manager */
  font-size: 0px;
  color: transparent;
}
.w-richtext figure.w-richtext-figure-type-image,
.w-richtext figure[data-rt-type="image"] {
  display: table;
}
.w-richtext figure.w-richtext-figure-type-image > div,
.w-richtext figure[data-rt-type="image"] > div {
  display: inline-block;
}
.w-richtext figure.w-richtext-figure-type-image > figcaption,
.w-richtext figure[data-rt-type="image"] > figcaption {
  display: table-caption;
  caption-side: bottom;
}
.w-richtext figure.w-richtext-figure-type-video,
.w-richtext figure[data-rt-type="video"] {
  width: 60%;
  height: 0;
}
.w-richtext figure.w-richtext-figure-type-video iframe,
.w-richtext figure[data-rt-type="video"] iframe {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}
.w-richtext figure.w-richtext-figure-type-video > div,
.w-richtext figure[data-rt-type="video"] > div {
  width: 100%;
}
.w-richtext figure.w-richtext-align-center {
  margin-right: auto;
  margin-left: auto;
  clear: both;
}
.w-richtext figure.w-richtext-align-center.w-richtext-figure-type-image > div,
.w-richtext figure.w-richtext-align-center[data-rt-type="image"] > div {
  max-width: 100%;
}
.w-richtext figure.w-richtext-align-normal {
  clear: both;
}
.w-richtext figure.w-richtext-align-fullwidth {
  width: 100%;
  max-width: 100%;
  text-align: center;
  clear: both;
  display: block;
  margin-right: auto;
  margin-left: auto;
}
.w-richtext figure.w-richtext-align-fullwidth > div {
  display: inline-block;
  /* padding-bottom is used for aspect ratios in video figures
      we want the div to inherit that so hover/selection borders in the designer-canvas
      fit right*/
  padding-bottom: inherit;
}
.w-richtext figure.w-richtext-align-fullwidth > figcaption {
  display: block;
}
.w-richtext figure.w-richtext-align-floatleft {
  float: left;
  margin-right: 15px;
  clear: none;
}
.w-richtext figure.w-richtext-align-floatright {
  float: right;
  margin-left: 15px;
  clear: none;
}
.w-nav {
  position: relative;
  background: #dddddd;
  z-index: 1000;
}
.w-nav:before,
.w-nav:after {
  content: " ";
  display: table;
  grid-column-start: 1;
  grid-row-start: 1;
  grid-column-end: 2;
  grid-row-end: 2;
}
.w-nav:after {
  clear: both;
}
.w-nav-brand {
  position: relative;
  float: left;
  text-decoration: none;
  color: #333333;
}
.w-nav-link {
  position: relative;
  display: inline-block;
  vertical-align: top;
  text-decoration: none;
  color: #222222;
  padding: 20px;
  text-align: left;
  margin-left: auto;
  margin-right: auto;
}
.w-nav-link.w--current {
  color: #0082f3;
}
.w-nav-menu {
  position: relative;
  float: right;
}
[data-nav-menu-open] {
  display: block !important;
  position: absolute;
  top: 100%;
  left: 0;
  right: 0;
  background: #C8C8C8;
  text-align: center;
  overflow: visible;
  min-width: 200px;
}
.w--nav-link-open {
  display: block;
  position: relative;
}
.w-nav-overlay {
  position: absolute;
  overflow: hidden;
  display: none;
  top: 100%;
  left: 0;
  right: 0;
  width: 100%;
}
.w-nav-overlay [data-nav-menu-open] {
  top: 0;
}
.w-nav[data-animation="over-left"] .w-nav-overlay {
  width: auto;
}
.w-nav[data-animation="over-left"] .w-nav-overlay,
.w-nav[data-animation="over-left"] [data-nav-menu-open] {
  right: auto;
  z-index: 1;
  top: 0;
}
.w-nav[data-animation="over-right"] .w-nav-overlay {
  width: auto;
}
.w-nav[data-animation="over-right"] .w-nav-overlay,
.w-nav[data-animation="over-right"] [data-nav-menu-open] {
  left: auto;
  z-index: 1;
  top: 0;
}
.w-nav-button {
  position: relative;
  float: right;
  padding: 18px;
  font-size: 24px;
  display: none;
  cursor: pointer;
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
  tap-highlight-color: rgba(0, 0, 0, 0);
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}
.w-nav-button:focus {
  outline: 0;
}
.w-nav-button.w--open {
  background-color: #C8C8C8;
  color: white;
}
.w-nav[data-collapse="all"] .w-nav-menu {
  display: none;
}
.w-nav[data-collapse="all"] .w-nav-button {
  display: block;
}
.w--nav-dropdown-open {
  display: block;
}
.w--nav-dropdown-toggle-open {
  display: block;
}
.w--nav-dropdown-list-open {
  position: static;
}
@media screen and (max-width: 991px) {
  .w-nav[data-collapse="medium"] .w-nav-menu {
    display: none;
  }
  .w-nav[data-collapse="medium"] .w-nav-button {
    display: block;
  }
}
@media screen and (max-width: 767px) {
  .w-nav[data-collapse="small"] .w-nav-menu {
    display: none;
  }
  .w-nav[data-collapse="small"] .w-nav-button {
    display: block;
  }
  .w-nav-brand {
    padding-left: 10px;
  }
}
@media screen and (max-width: 479px) {
  .w-nav[data-collapse="tiny"] .w-nav-menu {
    display: none;
  }
  .w-nav[data-collapse="tiny"] .w-nav-button {
    display: block;
  }
}
.w-tabs {
  position: relative;
}
.w-tabs:before,
.w-tabs:after {
  content: " ";
  display: table;
  grid-column-start: 1;
  grid-row-start: 1;
  grid-column-end: 2;
  grid-row-end: 2;
}
.w-tabs:after {
  clear: both;
}
.w-tab-menu {
  position: relative;
}
.w-tab-link {
  position: relative;
  display: inline-block;
  vertical-align: top;
  text-decoration: none;
  padding: 9px 30px;
  text-align: left;
  cursor: pointer;
  color: #222222;
  background-color: #dddddd;
}
.w-tab-link.w--current {
  background-color: #C8C8C8;
}
.w-tab-link:focus {
  outline: 0;
}
.w-tab-content {
  position: relative;
  display: block;
  overflow: hidden;
}
.w-tab-pane {
  position: relative;
  display: none;
}
.w--tab-active {
  display: block;
}
@media screen and (max-width: 479px) {
  .w-tab-link {
    display: block;
  }
}
.w-ix-emptyfix:after {
  content: "";
}
@keyframes spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
.w-dyn-empty {
  padding: 10px;
  background-color: #dddddd;
}
.w-dyn-hide {
  display: none !important;
}
.w-dyn-bind-empty {
  display: none !important;
}
.w-condition-invisible {
  display: none !important;
}
.wf-layout-layout {
  display: grid !important;
}
.wf-layout-cell {
  display: flex !important;
}
/*! normalize.css v3.0.3 | MIT License | github.com/necolas/normalize.css */
/**
 * 1. Set default font family to sans-serif.
 * 2. Prevent iOS and IE text size adjust after device orientation change,
 *    without disabling user zoom.
 */
html {
  font-family: sans-serif;
  /* 1 */
  -ms-text-size-adjust: 100%;
  /* 2 */
  -webkit-text-size-adjust: 100%;
  /* 2 */
}
/**
 * Remove default margin.
 */
body {
  margin: 0;
}
/* HTML5 display definitions
   ========================================================================== */
/**
 * Correct `block` display not defined for any HTML5 element in IE 8/9.
 * Correct `block` display not defined for `details` or `summary` in IE 10/11
 * and Firefox.
 * Correct `block` display not defined for `main` in IE 11.
 */
article,
aside,
details,
figcaption,
figure,
footer,
header,
hgroup,
main,
menu,
nav,
section,
summary {
  display: block;
}
/**
 * 1. Correct `inline-block` display not defined in IE 8/9.
 * 2. Normalize vertical alignment of `progress` in Chrome, Firefox, and Opera.
 */
audio,
canvas,
progress,
video {
  display: inline-block;
  /* 1 */
  vertical-align: baseline;
  /* 2 */
}
/**
 * Prevent modern browsers from displaying `audio` without controls.
 * Remove excess height in iOS 5 devices.
 */
audio:not([controls]) {
  display: none;
  height: 0;
}
/**
 * Address `[hidden]` styling not present in IE 8/9/10.
 * Hide the `template` element in IE 8/9/10/11, Safari, and Firefox < 22.
 */
[hidden],
template {
  display: none;
}
/* Links
   ========================================================================== */
/**
 * Remove the gray background color from active links in IE 10.
 */
a {
  background-color: transparent;
}
/**
 * Improve readability of focused elements when they are also in an
 * active/hover state.
 */
a:active,
a:hover {
  outline: 0;
}
/* Text-level semantics
   ========================================================================== */
/**
 * Address styling not present in IE 8/9/10/11, Safari, and Chrome.
 */
abbr[title] {
  border-bottom: 1px dotted;
}
/**
 * Address style set to `bolder` in Firefox 4+, Safari, and Chrome.
 */
b,
strong {
  font-weight: bold;
}
/**
 * Address styling not present in Safari and Chrome.
 */
dfn {
  font-style: italic;
}
/**
 * Address variable `h1` font-size and margin within `section` and `article`
 * contexts in Firefox 4+, Safari, and Chrome.
 */
h1 {
  font-size: 2em;
  margin: 0.67em 0;
}
/**
 * Address styling not present in IE 8/9.
 */
mark {
  background: #ff0;
  color: #000;
}
/**
 * Address inconsistent and variable font size in all browsers.
 */
small {
  font-size: 80%;
}
/**
 * Prevent `sub` and `sup` affecting `line-height` in all browsers.
 */
sub,
sup {
  font-size: 75%;
  line-height: 0;
  position: relative;
  vertical-align: baseline;
}
sup {
  top: -0.5em;
}
sub {
  bottom: -0.25em;
}
/* Embedded content
   ========================================================================== */
/**
 * Remove border when inside `a` element in IE 8/9/10.
 */
img {
  border: 0;
}
/**
 * Correct overflow not hidden in IE 9/10/11.
 */
svg:not(:root) {
  overflow: hidden;
}
/* Grouping content
   ========================================================================== */
/**
 * Address margin not present in IE 8/9 and Safari.
 */
figure {
  margin: 1em 40px;
}
/**
 * Address differences between Firefox and other browsers.
 */
hr {
  box-sizing: content-box;
  height: 0;
}
/**
 * Contain overflow in all browsers.
 */
pre {
  overflow: auto;
}
/**
 * Address odd `em`-unit font size rendering in all browsers.
 */
code,
kbd,
pre,
samp {
  font-family: monospace, monospace;
  font-size: 1em;
}
/* Forms
   ========================================================================== */
/**
 * Known limitation: by default, Chrome and Safari on OS X allow very limited
 * styling of `select`, unless a `border` property is set.
 */
/**
 * 1. Correct color not being inherited.
 *    Known issue: affects color of disabled elements.
 * 2. Correct font properties not being inherited.
 * 3. Address margins set differently in Firefox 4+, Safari, and Chrome.
 */
button,
input,
optgroup,
select,
textarea {
  color: inherit;
  /* 1 */
  font: inherit;
  /* 2 */
  margin: 0;
  /* 3 */
}
/**
 * Address `overflow` set to `hidden` in IE 8/9/10/11.
 */
button {
  overflow: visible;
}
/**
 * Address inconsistent `text-transform` inheritance for `button` and `select`.
 * All other form control elements do not inherit `text-transform` values.
 * Correct `button` style inheritance in Firefox, IE 8/9/10/11, and Opera.
 * Correct `select` style inheritance in Firefox.
 */
button,
select {
  text-transform: none;
}
/**
 * 1. Avoid the WebKit bug in Android 4.0.* where (2) destroys native `audio`
 *    and `video` controls.
 * 2. Correct inability to style clickable `input` types in iOS.
 * 3. Improve usability and consistency of cursor style between image-type
 *    `input` and others.
 * 4. CUSTOM FOR WEBFLOW: Removed the input[type="submit"] selector to reduce
 *    specificity and defer to the .w-button selector
 */
button,
html input[type="button"],
input[type="reset"] {
  -webkit-appearance: button;
  /* 2 */
  cursor: pointer;
  /* 3 */
}
/**
 * Re-set default cursor for disabled elements.
 */
button[disabled],
html input[disabled] {
  cursor: default;
}
/**
 * Remove inner padding and border in Firefox 4+.
 */
button::-moz-focus-inner,
input::-moz-focus-inner {
  border: 0;
  padding: 0;
}
/**
 * Address Firefox 4+ setting `line-height` on `input` using `!important` in
 * the UA stylesheet.
 */
input {
  line-height: normal;
}
/**
 * It's recommended that you don't attempt to style these elements.
 * Firefox's implementation doesn't respect box-sizing, padding, or width.
 *
 * 1. Address box sizing set to `content-box` in IE 8/9/10.
 * 2. Remove excess padding in IE 8/9/10.
 */
input[type='checkbox'],
input[type='radio'] {
  box-sizing: border-box;
  /* 1 */
  padding: 0;
  /* 2 */
}
/**
 * Fix the cursor style for Chrome's increment/decrement buttons. For certain
 * `font-size` values of the `input`, it causes the cursor style of the
 * decrement button to change from `default` to `text`.
 */
input[type='number']::-webkit-inner-spin-button,
input[type='number']::-webkit-outer-spin-button {
  height: auto;
}
/**
 * 1. CUSTOM FOR WEBFLOW: changed from `textfield` to `none` to normalize iOS rounded input
 * 2. CUSTOM FOR WEBFLOW: box-sizing: content-box rule removed
 *    (similar to normalize.css >=4.0.0)
 */
input[type='search'] {
  -webkit-appearance: none;
  /* 1 */
}
/**
 * Remove inner padding and search cancel button in Safari and Chrome on OS X.
 * Safari (but not Chrome) clips the cancel button when the search input has
 * padding (and `textfield` appearance).
 */
input[type='search']::-webkit-search-cancel-button,
input[type='search']::-webkit-search-decoration {
  -webkit-appearance: none;
}
/**
 * Define consistent border, margin, and padding.
 */
fieldset {
  border: 1px solid #c0c0c0;
  margin: 0 2px;
  padding: 0.35em 0.625em 0.75em;
}
/**
 * 1. Correct `color` not being inherited in IE 8/9/10/11.
 * 2. Remove padding so people aren't caught out if they zero out fieldsets.
 */
legend {
  border: 0;
  /* 1 */
  padding: 0;
  /* 2 */
}
/**
 * Remove default vertical scrollbar in IE 8/9/10/11.
 */
textarea {
  overflow: auto;
}
/**
 * Don't inherit the `font-weight` (applied by a rule above).
 * NOTE: the default cannot safely be changed in Chrome and Safari on OS X.
 */
optgroup {
  font-weight: bold;
}
/* Tables
   ========================================================================== */
/**
 * Remove most spacing between table cells.
 */
table {
  border-collapse: collapse;
  border-spacing: 0;
}
td,
th {
  padding: 0;
}

    </style>
   <body class="dashboard dashboard_1">
        <div class="full_container">
            <div class="inner_container">
                @include('navigation')
                <div id="content">
                    @include('header')
                    <div class="midde_cont">
                   
                        @yield('content')
                        
                    </div>
                    
                    <!-- Footer -->    
                </div>
            </div>
        </div>
            <!-- Scroll to top -->
        <script src="{{ asset('new/js/jquery.min.js')}}"></script>
      <script src="{{ asset('new/js/popper.min.js')}}"></script>
      <script src="{{ asset('new/js/bootstrap.min.js')}}"></script>
      <!-- wow animation -->
      <script src="{{ asset('new/js/animate.js')}}"></script>
      <!-- select country -->
      <script src="{{ asset('new/js/bootstrap-select.js')}}"></script>
      <!-- owl carousel -->
      <script src="{{ asset('new/js/owl.carousel.js')}}"></script> 
      <!-- chart js -->
      <!-- <script src="{{ asset('new/js/Chart.min.js')}}"></script> -->
      <!-- <script src="{{ asset('new/js/Chart.bundle.min.js')}}"></script> -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.js" integrity="sha512-Lii3WMtgA0C0qmmkdCpsG0Gjr6M0ajRyQRQSbTF6BsrVh/nhZdHpVZ76iMIPvQwz1eoXC3DmAg9K51qT5/dEVg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="{{ asset('new/js/select2.full.min.js')}}"></script>
      <script src="{{ asset('new/js/utils.js')}}"></script>
      <!-- <script src="{{ asset('new/js/analyser.js')}}"></script> -->
      <!-- nice scrollbar -->
      <script src="{{ asset('new/js/perfect-scrollbar.min.js')}}"></script>
      <script>
         var ps = new PerfectScrollbar('#sidebar');
      </script>

      <!-- custom js -->
      <script src="{{ asset('new/js/custom.js')}}"></script>
      <script src="{{ asset('new/js/chart_custom_style1.js')}}"></script>
      
      <script type="text/javascript">
        $(document).ready(function (){
          $('.btn-copy').click(function (){
            $('.example-2').append($('.example-2').html())            
          })
        })
      </script>
      <script type="text/javascript">
        $('#category_id').on('change', function() {
            var category_id =  this.value;
            var token = $("meta[name='csrf-token']").attr("content");
            $.ajax({
                url: 'get_category_detail',
                type: 'post',
                data: {category_id:category_id, _token: '{{csrf_token()}}'},
                success:function(data){
                  if (data.category == "Vouchers") {
                    $('#voucher').show();
                  }
                }
            });
        });
        $(document).ready(function() {
            $(".select_group").select2();
        });
        $(document).ready(function () {
            $(".addmore").click(function () {
                // var cloneIndex = $(".abcd").length;
                // $(".abcd:last").clone().appendTo(".clonedata");
                // console.log(cloneIndex);
                // if (cloneIndex > 0){
                //     $('.abcd:last').find('.checks').attr("value", ' ');
                //     $('.abcd:last').find('.htmls').attr("value", cloneIndex);
                // }
                $(".abcd")
                  .eq(0)
                  .clone()
                  .find("input").val("").end() // ***
                  .show()
                  .insertAfter(".abcd:last");
            });
            $(".clonedata").on('click', '.removemore', function () {
                var $tr = $(this).closest('.abcd');
                if ($tr.index() > 0){
                    $(".abcd:last").remove();
                }
            });
        });
      </script>
        <script>
            $(function(){
                var dtToday = new Date();
                
                var month = dtToday.getMonth() + 1;
                var day = dtToday.getDate();
                var year = dtToday.getFullYear();
                if(month < 10)
                    month = '0' + month.toString();
                if(day < 10)
                    day = '0' + day.toString();
                
                var maxDate = year + '-' + month + '-' + day;
            
                // or instead:
                // var maxDate = dtToday.toISOString().substr(0, 10);
                $('#txtDate').attr('min', maxDate);
            });
        </script>
</body>
            
</html>
