<form action="{{ route('make.payment') }}" method="POST">
    @csrf
    <input type="text" name="amount" required placeholder="Amount">
    <input type="text" name="currency" required placeholder="Currency">
    <input type="text" name="description" required placeholder="Description">
    <input type="text" name="full_name" required placeholder="Full Name">
    <input type="text" name="buyer_phone" required placeholder="Phone">
    <input type="email" name="buyer_email" required placeholder="Email">
    <input type="text" name="address" required placeholder="Address">
    <input type="text" name="city" required placeholder="City">
    <input type="text" name="zip" required placeholder="Zip Code">
    <input type="hidden" name="order_id" value="1234"> <!-- or generate dynamically -->
    <input type="hidden" name="items" value="[]"> <!-- replace with actual items data -->
    <input type="hidden" name="success-url" value="{{ route('success-url') }}">
    <input type="hidden" name="cancel-url" value="{{ route('cancel-url') }}">
    <input type="hidden" name="failure-url" value="{{ route('failure-url') }}">
    
    <button type="submit">Pay Now</button>
</form>
