<div class="Dashboard">
    <div class="container">
        <section class="Hero">
            <div class="text">
                <h1>Hi {{ auth()->user()->first_name }}</h1>
            </div>
        </section>

        <section class="stats">
            <div class="stat">
                <span>{{ $count_users }}</span>
                <span>{{ Str::plural('user', $count_users) }} and {{ $count_admins }} {{ Str::plural('admin', $count_admins) }}</span>
            </div>

            <div class="stat">
                <span>{{ $count_products }}</span>
                <span>{{ Str::plural('product', $count_products) }} and {{ $count_product_categories }} {{ Str::plural('category', $count_product_categories) }}</span>
            </div>
        </section>
    </div>
</div>
