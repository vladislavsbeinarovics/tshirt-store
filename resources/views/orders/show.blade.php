<x-layout.app title="Order Info" class="flex justify-center items-center gap-4">
    <x-ui.section>
        <table>
                <tr>
                    <th>ID<th>
                    <td>{{ $order['id'] }}</td>
                </tr>

                <tr>
                    <th>Status<th>
                    <td>{{ $order['status'] }}</td>
                </tr>

                <tr>
                    <th>Cart Total<th>
                    <td>{{ $order['cart_total'] }}</td>
                </tr>

                <tr>
                    <th>Payment Method<th>
                    <td>{{ $order['payment_method'] }}</td>
                </tr>

                <tr>
                    <th>Address<th>
                    <td>{{ $order['address'] }}</td>
                </tr>

                <tr>
                    <th>Postal Code<th>
                    <td>{{ $order['postal_code'] }}</td>
                </tr>
            </tbody>
        </table>
    </x-ui.section>
</x-layout.app>