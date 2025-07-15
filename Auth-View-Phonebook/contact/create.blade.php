<!DOCTYPE html>
<html>
<head>
<style> 
input[type=text] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
}
select[type=text] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
}
</style>
</head>
<body>
@if(session('success'))
<div>
{{ session('success') }}
</div>
@endif
<h2>Padded input fields</h2>

<form  method="post" action="{{ route('contact.store') }}">
     @csrf
     
    <label for="name">Name</label>
    <input type="text" id="name" name="name">
    @error('name')
    <div style="color: red;">{{ $message }}</div>
    @enderror
    <label for="mobile">Mobile</label>
    <input type="text" id="mobile" name="mobile">
    <label for="email">Email</label>
    <input type="text" id="email" name="email">
    @error('email')
        <div style="color: red;">{{ $message }}</div>
    @enderror
    <label for="email">Group</label>
    <select type ="text" name="group">
         <option value="0">--Select--</option>
        <option value="family">Family</option>
        <option value="friends">Friends</option>
        <option value="colleagues ">Colleagues </option>
    </select>
    <button type="submit">Submit</button>
</form>

</body>
</html>


