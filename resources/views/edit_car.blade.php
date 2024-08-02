<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Car</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
  <style>
    * {
      font-family: "Lato", sans-serif;
    }
  </style>
</head>

<body>
  <main>
    <div class="container my-5">
      <div class="bg-light p-5 rounded">
        <h2 class="fw-bold fs-2 mb-5 pb-2">Edit Car</h2>
        <form action="{{ route('cars.update', $car->id) }}" method="POST" class="px-md-5" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          
          <div class="form-group mb-3 row">
            <label for="cartitle" class="form-label col-md-2 fw-bold text-md-end">Car Title:</label>
            <div class="col-md-10">
              <input type="text" id="cartitle" placeholder="BMW" class="form-control py-2" name="cartitle" value="{{ old('cartitle', $car->cartitle) }}" required />
              @error('cartitle')
              <div class="alert alert-warning">{{ $message }}</div>
              @enderror
            </div>
          </div>
          
          <div class="form-group mb-3 row">
            <label for="price" class="form-label col-md-2 fw-bold text-md-end">Price:</label>
            <div class="col-md-10">
              <input type="number" id="price" step="0.1" placeholder="Enter price" class="form-control py-2" name="price" value="{{ old('price', $car->price) }}" required />
              @error('price')
              <div class="alert alert-warning">{{ $message }}</div>
              @enderror
            </div>
          </div>
          
          <div class="form-group mb-3 row">
            <label for="description" class="form-label col-md-2 fw-bold text-md-end">Description:</label>
            <div class="col-md-10">
              <textarea id="description" cols="30" rows="5" class="form-control py-2" name="description">{{ old('description', $car->description) }}</textarea>
              @error('description')
              <div class="alert alert-warning">{{ $message }}</div>
              @enderror
            </div>
          </div>
          
          <div class="form-group mb-3 row">
            <label for="image" class="form-label col-md-2 fw-bold text-md-end">Image:</label>
            <div class="col-md-10">
              <input type="file" id="image" name="image" class="form-control py-2" alt="Car Image">
              @if ($car->image)
                <div class="mt-2">
                  <img src="{{ asset($car->image) }}" alt="Current Car Image" style="max-width: 200px; max-height: 200px; object-fit: cover;">
                  <p class="text-muted">Current Image</p>
                </div>
              @endif
              
              @error('image')
              <div class="alert alert-warning">{{ $message }}</div>
              @enderror
            </div>
          </div>
          
          <hr>
          
          <div class="form-group mb-3 row">
            <label for="published" class="form-label col-md-2 fw-bold text-md-end">Published:</label>
            <div class="col-md-10">
              <input type="checkbox" id="published" class="form-check-input" style="padding: 0.7rem;" name="published" @checked(old('published', $car->published)) />
              @error('published')
              <div class="alert alert-warning">{{ $message }}</div>
              @enderror
            </div>
          </div>
          
          <div class="text-md-end">
            <button class="btn mt-4 btn-secondary text-white fs-5 fw-bold border-0 py-2 px-md-5" type="submit">
              Edit Car
            </button>
          </div>
        </form>
      </div>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>