<?php 
    $counter = 1; 
    $categories = Category::all();
?>

<div class="container clearfix">
    <div class="row">
        <div class="pull-left">
            Filter By Category:
            <form id="filter" action="/" method="post">
                <select class="form-control" id="cat-filter" name="cat-filter">
                    <option value="">Select from...</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" 
                            <?php if (isset($filters['cat-filter']) && $filters['cat-filter'] == $category->id) 
                                echo ' selected="selected"'; ?>>{{ $category->name }}</option>
                    @endforeach
                </select>
            </form>
        </div>
        <div class="pull-right">
            <a href="{{ ($orderId != NULL) ? ("/basket/".$orderId) : "#" }}" class="btn btn-primary"><span>{{ $items }}</span> items in basket</a>
        </div>
    </div>
    <div class="row">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Quantity in stock</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <th scope="row">{{ $counter }}</th>
                    <td>{{ $product->getName() }}</td>
                    <td>{{ $product->getCategoryName() }}</td>
                    <td>
                        {{ ($product->getOldPrice() != 0.00) ? ("<strike>£ " . $product->getOldPrice() . "</strike><br />"): "" }}
                        £ {{ $product->getPrice() }}</td>
                    <td>{{ $product->getAvailableQuantity() }}</td>
                    <td class="text-center">
                        <a href="/add/{{ $product->id }}" class="btn btn-primary addButton" data-quantity="{{ $product->getAvailableQuantity() }}">Add to Basket</a></td>
                </tr>
                <?php $counter++; ?>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- JS --}}
@section('footer-js')
    @parent
    <script type="text/javascript">jQuery(document).ready(function ($) {
            Shopping.Cart.init();
        });</script>
    @stop