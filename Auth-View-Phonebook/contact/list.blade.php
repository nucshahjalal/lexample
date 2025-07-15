<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}

.button {
  background-color: green; /* Green */
  border: none;
  color: white;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  margin: 4px 2px;
  cursor: pointer;
}

.button2 {
  background-color: red; /* Green */
  border: none;
  color: white;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  margin: 4px 2px;
  cursor: pointer;
}

</style>
</head>
<body>

<h1>Contact Information List</h1>

<?php
 if(Auth::user()->type == 'admin'){ ?>
    <h2  style="text-align:right;"><a href="{{ route('contact.create') }}">Create</a></h2>
 <?php } elseif (!Auth::user()->type == 'admin') { ?> 
    <h2  style="text-align:right;"><a href="{{ route('contact.create') }}">Create</a></h2>
<?php  } ?>
    
<h2  style="text-align:right;">Search <input class="typeahead" type="text" id="myInput" name="Search"></h2>

<table id="customers">
  <tr>
    <th>#SL</th>
    <th>Name</th>
    <th>Mobile</th>
    <th>Email</th>
    <th>Created At</th>
    <th>Updated At</th>
    <th>Action</th>
  </tr>
  
  @foreach($contacts as $key => $value)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $value->name }}</td>
        <td>{{ $value->mobile }}</td>
        <td>{{ $value->email }}</td>
        <td>{{ $value->created_at }}</td>
        <td>{{ $value->updated_at }}</td>
        <td>
            <?php
                if(Auth::user()->type == 'admin'){ ?>
                    <form action="{{ route('contact.destroy',$value->id) }}" method="POST">
                        <a class="button" href="{{ route('contact.edit',$value->id) }}">Edit</a><br>
                         @csrf
                         @method('DELETE')
                         <button class="button2" type="submit">Delete</button>
                    </form>
                <?php } elseif (Auth::user()->type == 'editor') { ?> 
                  <form action="{{ route('contact.destroy',$value->id) }}" method="POST">
                    <a class="button" href="{{ route('contact.edit',$value->id) }}">Edit</a><br>
                </form>
            <?php  } ?>
        </td>
    </tr>
   @endforeach
</table>
     

</html>

<div>
<!--{{ $contacts->links() }}-->
</div>


