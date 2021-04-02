@extends('front.layouts.master')
@section('title','İletişim')
@section('bg','https://thumbs.dreamstime.com/z/web-contact-us-icons-post-website-internet-page-concept-black-paper-isolated-white-background-35215369.jpg')
@section('content')

<div class="col-md-8">
  @if(session('success'))
  <div class="alert alert-success">
    {{session('success')}}
  </div>
  @endif
  @if($errors->any())
  <div class="alert alert-danger">
    <p>Lütfen Bilgileri Kontrol Ediniz ! </p>

    <ul>
      @foreach($errors->all() as $error)
      <li>
        {{$error}}
      </li>
      @endforeach
    </ul>
  </div>
  @endif
  <p> Bizimle iletişime mi geçmek istiyorsunuz ? Formu doldurup bize gönderdikten sonra en kısa sürede size dönüş yapacağız!</p>

  <form method="post" action="{{route('contact.post')}}">
    @csrf
    <div class="control-group">
      <div class="form-group">
        <label>İsim</label>
        <input type="text" value="{{old('name')}}" class="form-control" placeholder="İsim" name="name" required>

      </div>
    </div>


    <div class="control-group">
      <div class="form-group">
        <label>E-mail Adres</label>
        <input type="email" value="{{old('email')}}" class="form-control" placeholder="E-mail Adres" name="email" required>

      </div>
    </div>


    <div class="control-group">
      <div class="form-group col-xs-12">
        <label>Konu</label>
        <select class="form-control" name="topic">
          <option @if(old('topic'))=='Bilgi' selected @endif>Bilgi</option>
          <option @if(old('topic'))=='Destek' selected @endif>Destek</option>
          <option @if(old('topic'))=='Genel' selected @endif>Genel</option>
        </select>
      </div>
    </div>

    <div class="control-group">
      <div class="form-group">
        <label>Mesajınız</label>
        <textarea rows="5" class="form-control" placeholder="Mesajınız" name="message" require>{{old('message')}}</textarea>
      </div>
    </div>


    <br>
    <div id="success"></div>
    <button type="submit" class="btn btn-primary" id="sendMessageButton">Gönder</button>
  </form>
</div>

<div class="col-md-4">
  <div class="card">
    <div class="card-header">
      Adres Bilgileri
    </div>
    <div class="card-body">
      <blockquote class="blockquote mb-0">
        <p>Emek Yaşilırmak Cd. No:3 D:27 07060 Kepez/Antalya</p>
        <footer class="blockquote-footer">Kepez Belediye Karşısı Siyah Bina<cite title="Source Title">/Ofis</cite></footer>
      </blockquote>
    </div>
  </div>

  @endsection