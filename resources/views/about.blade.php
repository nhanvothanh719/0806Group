@extends('layouts.main')
@section('custom-css')
<style>
  body {
    margin: 0;
  }

  html {
    box-sizing: border-box;
  }

  *,
  *:before,
  *:after {
    box-sizing: inherit;
  }

  .column {
    float: left;
    width: 33.3%;
    margin-bottom: 16px;
    padding: 0 8px;
  }

  .card {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    margin: 8px;
    background-color: #f5f5f5;
  }

  .about-section {
    text-align: center;
    color: black;
    padding: 0px 30px;
  }

  .container {
    padding: 5px 16px;
  }

  .container::after,
  .row::after {
    content: "";
    clear: both;
    display: table;
  }

  .title {
    color: grey;
    font-family: "Trebuchet MS", Helvetica, sans-serif;
  }

  .h2 {
    font-family: Georgia, serif;
  }

  .text {
    font-family: 'Courier New', monospace;
  }

  .card:hover {
    background-color: #d6d6d6;
  }

  @media screen and (max-width: 650px) {
    .column {
      width: 100%;
      display: block;
    }
  }
</style>
@endsection
@section('content')
<div class="about-section">
  <div class="row">
    <div class="column">
      <div class="card border-danger">
        <div class="container">
          <h2 class="h2">Kiet</h2>
          <p class="title">Product Owner</p>
          <p class="text">TCD04RE</p>
        </div>
      </div>
    </div>

    <div class="column">
      <div class="card border-warning">
        <div class="container">
          <h2 class="h2">Tu</h2>
          <p class="title">Scrum Master</p>
          <p class="text">TCD04RE</p>
        </div>
      </div>
    </div>

    <div class="column">
      <div class="card border-success">
        <div class="container">
          <h2 class="h2">Huan</h2>
          <p class="title">Developer</p>
          <p class="text">TCD04RE</p>
        </div>
      </div>
    </div>

    <div class="column">
      <div class="card border-warning">
        <div class="container">
          <h2 class="h2">Duc</h2>
          <p class="title">Developer</p>
          <p class="text">TCD04RE</p>
        </div>
      </div>
    </div>

    <div class="column">
      <div class="card border-success">
        <div class="container ">
          <h2 class="h2">Dan</h2>
          <p class="title">Developer</p>
          <p class="text">TCD04RE</p>
        </div>
      </div>
    </div>

    <div class="column">
      <div class="card border-danger">
        <div class="container">
          <h2 class="h2">Tan</h2>
          <p class="title">Developer</p>
          <p class="text">TCD04RE</p>
        </div>
      </div>
    </div>
  </div>


  @endsection
