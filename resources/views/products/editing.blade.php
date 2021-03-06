@extends("base")

@section("content")

    <h3>Update Product</h3>

    <form action="{{ action('ProductController@store') }}" method="POST" class="formBody">
        {{ csrf_field() }}

        <fieldset>
            <label for="name">Product name:  </label>
            <input type="text" id="name" name="name" required value="{{ $product->name }}">
            <br/>

            <label for="price">Product price:  </label>
            <input
                    type="number"
                    id="price"
                    name="price"
                    required
                    min="0"
                    max="999.99"
                    step="0.01"
                    value="{{ $product->price }}"
            >
            <br/>

            <label for="stock">Product stock:  </label>
            <input
                    type="number"
                    id="stock"
                    name="stockQuantity"
                    required
                    min="0"
                    max="100"
                    value="{{ $product->stockQuantity }}"
            >
            <br/>
        </fieldset>

        <fieldset>
            <input type="submit" value="Save item"/>
            <input type="reset" value="Clear fields"/>
        </fieldset>
    </form>
@endsection