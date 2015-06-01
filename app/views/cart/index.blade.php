<?php 
    $counter = 1;
?>

<div class="container clearfix">
    <div class="row">
        <h1>Order Summary</h1>
        {{ (isset($error_msg)) ? ("<p class='bg-danger error-msg'>". $error_msg ."</p>") : "" }}
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Category</th>
                <th>Quantity ordered</th>
                <th>Product Price</th>
            </tr>
            </thead>
            <tbody>
                <form action="/basket/update" method="post">
                    <input type="hidden" name="orderId" value="{{ $order_id }}" />
                @foreach($items as $item)
                    <tr>
                        <th scope="row">{{ $counter }}</th>
                        <td>{{ $item->products->getName() }}</td>
                        <td>{{ $item->products->getCategoryName() }}</td>
                        <td>
                            <input type="text" name="qty-{{ $item->products->id }}" value="{{ $item->getQuantity() }}" />
                            <span><a href="/basket/delete/{{ $order_id }}/{{ $item->products->id }}" >X</a></span>
                        </td>
                        <td>
                            {{ ($item->products->getOldPrice() != 0.00) ? ("<strike>£ " . $item->products->getOldPrice() . "</strike><br />"): "" }}
                            £ {{ $item->products->getPrice() }}</td>
                    </tr>
                    <?php $counter++; ?>
                @endforeach
                    <tr>
                        <td colspan="4" class="text-right">
                            <input type="submit" value="Update Basket" />
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-right">Total</td>
                        <td>£ {{ $total }}</td>
                    </tr>
                </form>
                <form action="/basket/voucher" method="post">
                    <input type="hidden" name="orderId" value="{{ $order_id }}" />
                    <tr>
                        <td></td>
                        <td colspan="2" class="text-right">
                            <input type="text" name="voucher_code" 
                                    placeholder="Voucher Code" value="{{ isset($code) ? $code : "" }}" />
                        </td>
                        <td><input type="submit" value="Apply" /></td>
                        <td></td>
                    </tr>
                </form>
                @if(isset($discount))
                    <tr>
                        <td colspan="4" class="text-right">Discount</td>
                        <td>- £ {{ $discount }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-right">Total</td>
                        <td><?php $total = $total - $discount; ?>
                            £ {{ $total }}</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <a href="/">Continue shopping >></a>
        <form action="/basket/checkout" method="post">
            <input type="hidden" name="orderId" value="{{ $order_id }}" />
            <input type="hidden" name="total" value="{{ $total }}" />
            <input type="submit" class="btn btn-primary pull-right" value="Checkout" />
        </form>
    </div>
</div>