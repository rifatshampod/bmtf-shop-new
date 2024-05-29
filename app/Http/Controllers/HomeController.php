<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomePageOneVisibility;
use App\Models\Brand;
use App\Models\Slider;
use App\Models\Category;
use App\Models\MaintainanceText;
use App\Models\SubCategory;
use App\Models\ChildCategory;
use App\Models\PopularCategory;
use App\Models\Product;
use App\Models\BannerImage;
use App\Models\Service;
use App\Models\Blog;
use App\Models\AboutUs;
use App\Models\ContactPage;
use App\Models\ErrorPage;
use App\Models\PopularPost;
use App\Models\BlogCategory;
use App\Models\BreadcrumbImage;
use App\Models\CustomPagination;
use App\Models\Faq;
use App\Models\CustomPage;
use App\Models\TermsAndCondition;
use App\Models\Vendor;
use App\Models\Subscriber;
use App\Mail\SubscriptionVerification;
use App\Mail\ContactMessageInformation;
use App\Helpers\MailHelper;
use App\Models\EmailTemplate;
use App\Models\ProductReview;
use App\Models\ProductSpecification;
use App\Models\ProductGallery;
use App\Models\Setting;
use App\Models\ContactMessage;
use App\Models\BlogComment;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use App\Models\Testimonial;
use App\Models\GoogleRecaptcha;
use App\Models\Order;
use App\Models\ShopPage;
use App\Models\SeoSetting;
use App\Models\FlashSale;
use App\Models\FlashSaleProduct;
use App\Rules\Captcha;
use Mail;
use Str;
use Session;
use Cart;
use Carbon\Carbon;
use Route;
use App\Models\FooterSocialLink;
use App\Models\AnnouncementModal;
use App\Models\MegaMenuCategory;
use App\Models\MenuVisibility;
use App\Models\GoogleAnalytic;
use App\Models\FacebookPixel;
use App\Models\TawkChat;
use App\Models\CookieConsent;
use App\Models\FeaturedCategory;
use App\Models\FooterLink;
use App\Models\Footer;
use App\Models\User;
use App\Events\LaravelReact;
use GuzzleHttp\Client;

class HomeController extends Controller
{

    public function websiteSetup()
    {
        $language = array(
            'blogs details' => 'Blogs details',
            'Search products' => 'Search products',
            'products' => 'Products',
            'Product' => 'Product',
            'Somethings went wrong' => 'Somethings went wrong',
            'Become seller' => 'Become seller',
            'Cart' => 'Cart',
            'Checkout' => 'Checkout',
            'FAQ' => 'FAQ',
            'Forgot password' => 'Forgot password',
            'Login' => 'Login',
            'Privacy Policy' => 'Privacy Policy',
            'Product Compaire' => 'Product Compaire',
            'Signup' => 'Signup',
            'Term and Conditions' => 'Terms and Conditions',
            'home' => 'Home',
            'About us' => 'About us',
            'Contact Us' => 'Contact Us',
            'Customers Feedback' => 'Customers Feedback',
            'My Latest News' => 'My Latest News',
            'Shop Now' => 'Shop Now',
            'Showing' => 'Showing',
            'results' => 'Results',
            'View by' => 'View by',
            'Product categories' => 'Product categories',
            'Price Range' => 'Price Range',
            'Price' => 'Price',
            'Brands' => 'Brands',
            'Send' => 'Send',
            'Reset Password' => 'Reset Password',
            'OTP' => 'OTP',
            'Email Address' => 'Email Address',
            'Email' => 'Email',
            'New Password' => 'New Password',
            'Confirm Password' => 'Confirm Password',
            'Reset' => 'Reset',
            'Please verify your account. If you didnt get OTP, please resend your OTP and verify' => 'Please verify your account. If you didnt get OTP, please resend your OTP and verify',
            'Send OTP' => 'Send OTP',
            'Login Successfully' => 'Login Successfully',
            'Invalid Credentials' => 'Invalid Credentials',
            'Log In' => 'Log In',
            'Password' => 'Password',
            'Remember Me' => 'Remember Me',
            'Dont\'t have an account' => 'Dont\'t have an account',
            'sign up free' => 'Sign up free',
            'dashboard' => 'Dashboard',
            'profile' => 'Profile',
            'Your Dashboard' => 'Your Dashboard',
            'Switch Dashboard' => 'Switch Dashboard',
            'Dashboard' => 'Dashboard',
            'Personal Info' => 'Personal Info',
            'Order' => 'Order',
            'Wishlist' => 'Wishlist',
            'Address' => 'Address',
            'Reviews' => 'Reviews',
            'Change Password' => 'Change Password',
            'Logout' => 'Logout',
            'Add New Address' => 'Add New Address',
            'First Name' => 'First Name',
            'Demo Name' => 'Demo Name',
            'Last Name' => 'Last Name',
            'Phone Number' => 'Phone Number',
            'phone' => 'Phone',
            'Country' => 'Country',
            'Select' => 'Select',
            'State' => 'State',
            'City' => 'City',
            'your address here' => 'Your address here',
            'Office' => 'Office',
            'Save Address' => 'Save Address',
            'Name' => 'Name',
            'Hello' => 'Hello',
            'Welcome to your Profile' => 'Welcome to your Profile',
            'New Orders' => 'New Orders',
            'Delivery Completed' => 'Delivery Completed',
            'Total Orders' => 'Total Orders',
            'Personal Information' => 'Personal Information',
            'Date' => 'Date',
            'Amount' => 'Amount',
            'Action' => 'Action',
            'View Details' => 'View Details',
            'Old Password' => 'Old Password',
            'Re-enter Password' => 'Re-enter Password',
            'Update Password' => 'Update Password',
            'Cancel' => 'Cancel',
            'Read Only' => 'Read Only',
            'Update Profile' => 'Update Profile',
            'Profile of at least Size' => 'Profile of at least Size',
            'Max 5mb' => 'Max 5mb',
            'Pending review' => 'Pending review',
            'Clear wishlist' => 'Clear wishlist',
            'Clean Wishlist' => 'Clean Wishlist',
            'View Cards' => 'View Cards',
            'Verify You' => 'Verify You',
            'Verify' => 'Verify',
            'Create Account' => 'Create Account',
            'in ecoShop' => 'In ShopUs',
            'Already have an Account' => 'Already have an Account',
            'Congratulation Your seller request successfully delivered' => 'Congratulation Your seller request successfully delivered',
            'Please Login First' => 'Please Login First',
            'Seller Information' => 'Seller Information',
            'Fill the form below or write us We will help you as soon as possible' => 'Fill the form below or write us We will help you as soon as possible',
            'Shop Information' => 'Shop Information',
            'Shop Name' => 'Shop Name',
            'Your address Here' => 'Your address Here',
            'I agree all terms and condition in ecoShop' => 'I agree all terms and condition in BMTF Shop',
            'Create Seller Account' => 'Create Seller Account',
            'Update Logo' => 'Update Logo',
            'Gifs work too' => 'Gifs work too',
            'Update Cover' => 'Update Cover',
            'Cover of at least Size' => 'Cover of at least Size',
            'blogs' => 'Blogs',
            'By Admin' => 'By Admin',
            'Search' => 'Search',
            'Latest Post' => 'Latest Post',
            'Categories' => 'Categories',
            'Our Newsletter' => 'Our Newsletter',
            'Follow our newsletter to stay updated about us' => 'Follow our newsletter to stay updated about us',
            'Subscribe' => 'Subscribe',
            'Message' => 'Message',
            'Submit Review' => 'Submit Review',
            'Comments' => 'Comments',
            'Blog Not Found' => 'Blog Not Found',
            'Remove from Cart' => 'Remove from Cart',
            'No items found' => 'No items found',
            'View Cart' => 'View Cart',
            'Checkout Now' => 'Checkout Now',
            'Get Return within' => 'Get Return within 30 days',
            'cart' => 'Cart',
            'Clear Cart' => 'Clear Cart',
            'Update Cart' => 'Update Cart',
            'Proceed to Checkout' => 'Proceed to Checkout',
            'checkout' => 'Checkout',
            'Addresses' => 'Addresses',
            'Billing Address' => 'Billing Address',
            'Shipping Address' => 'Shipping Address',
            'Add New' => 'Add New',
            'Selected' => 'Selected',
            'Add new address' => 'Add new address',
            'Apply Coupon' => 'Apply Coupon',
            'Order Summary' => 'Order Summary',
            'total' => 'Total',
            'SUBTOTAL' => 'SUBTOTAL',
            'Shipping' => 'Shipping',
            'Cash On Delivery' => 'Cash On Delivery',
            'Transaction Information' => 'Transaction Information',
            'Place Order Now' => 'Place Order',
            'Get In Touch' => 'Get In Touch',
            'Send Now' => 'Send Now',
            'Back to Shop' => 'Back to Shop',
            'Empty! You don\'t Cart any Products' => 'Empty! Haven\'t any product on your shopping cart.',
            'Empty! You don\'t Wishlist any Products' => 'Empty! Haven\'t any product on your wishlist.',
            'Frequently asked questions' => 'Frequently asked questions',
            'Have Any Qustion' => 'Have Any Question',
            'Days' => 'Days',
            'Hours' => 'Hours',
            'Minutes' => 'Minutes',
            'Seconds' => 'Seconds',
            'Sorry! We cant\'t Find that page!' => 'Sorry! We cant\'t Find that page!',
            'Add To Cart' => 'Add To Cart',
            'Item added' => 'Item added',
            'Go To Cart' => 'Go To Cart',
            'Select One' => 'Select One',
            'Get the Coupon' => 'Get the Coupon',
            'View More' => 'View More',
            'OFF' => 'OFF',
            'Main Menu' => 'Main Menu',
            'About' => 'About',
            'Contact' => 'Contact',
            'Delivered on' => 'Delivered on',
            'Your order is declined' => 'Your order is declined',
            'Pending' => 'Pending',
            'Progress' => 'Progress',
            'Delivered' => 'Delivered',
            'Order ID' => 'Order ID',
            'Type' => 'Type',
            'Print PDF' => 'Print PDF',
            'quantity' => 'Quantity',
            'review' => 'Review',
            'Shipping Cost' => 'Shipping Cost',
            'Write Your Reviews' => 'Write Your Reviews',
            'Contact Info' => 'Contact Info',
            'Hi' => 'Hi',
            'Settings' => 'Settings',
            'Sign Out' => 'Sign Out',
            'All Categories' => 'All Categories',
            'Shop' => 'Shop',
            'Sellers' => 'Sellers',
            'Pages' => 'Pages',
            'Seller Login' => 'Seller Login',
            'Account' => 'Account',
            'Track Order' => 'Track Order',
            'Support' => 'Support',
            'compare' => 'Compare',
            'Product Comparison' => 'Product Comparison',
            'Select products to see the differences and similarities between them' => 'Select products to see the differences and similarities between them',
            'Star Rating' => 'Star Rating',
            'Availability' => 'Availability',
            'In Stock' => 'In Stock',
            'Out of Stock' => 'Out of Stock',
            'Specification' => 'Specification',
            'Your Compare List Is Empty' => 'Your Compare List Is Empty',
            'Store Open' => 'Store Open',
            'Description' => 'Description',
            'Seller Info' => 'Seller Info',
            'Introduction' => 'Introduction',
            'Related Product' => 'Related Product',
            'Report Products' => 'Report Products',
            'Enter Report Ttile' => 'Enter Report Ttile',
            'Enter Report Note' => 'Enter Report Note',
            'Submit Report' => 'Submit Report',
            'Report This Item' => 'Report This Item',
            'Share This' => 'Share This',
            'View Shop' => 'View Shop',
            'Track Your Order' => 'Track Your Order',
            'Enter your order tracking number and your secret id' => 'Enter your order tracking number and your secret id',
            'Track Now' => 'Track Now',
            'wishlist' => 'Wishlist',
            'Update address' => 'Update address',
            'Our blogs' => 'Our blogs',
            'Show more' => 'Show more',
            'leave a comment' => 'Leave a comment',
            'Write something' => 'Write something',
            'Your cart' => 'Your cart',
            'Something missing' => 'Something missing',
            'Select your payment system' => 'Select your payment system',
            'Discount code' => 'Discount code',
            'Apply' => 'Apply',
            'Bank Payment' => 'Bank Payment',
            'Subject' => 'Subject',
            'Seller terms and conditions' => 'Seller terms and conditions',
            'Completed' => 'Completed',
            'Declined' => 'Declined',
            'Delivered On' => 'Delivered On',
            'Total Paid' => 'Total Paid',
            'of' => 'of',
            'Products Available' => 'Products Available',
            'Products not Available' => 'Products not Available',
            'SKU' => 'SKU',
            'order number' => 'Order number',
            'order tracking nubmer' => 'Order tracking nubmer',
            'Invalid data' => 'Invalid data',
            'Delivery Date' => 'Delivery Date',
            'Accept All' => 'Accept All',
            'Deny' => 'Deny',
            'Read more' => 'Read more',
            'category' => 'Category',
            'Coupon Applied' => 'Coupon Applied',
            'Discount coupon' => 'Discount coupon',
            'Your total price not able to apply coupon' => 'Your total price not able to apply coupon',
            'Please Select Your Payment Method' => 'Please Select Your Payment Method',
            'Please Select Shipping Rule' => 'Please Select Shipping Rule',
            'Enabled Location' => 'Enabled Location',
            'Not Now' => 'Not Now',
            'Choose Product' => 'Choose Product',
            'Make Your Payment' => 'Make Your Payment',
            'Fast Delivery' => 'Fast Delivery',
            'on boarding subtitle' => 'BMTF Shop is an online store. Its has  50k+ Products. you can buy products in easy way.',
            'next' => 'Next',
            'see all' => 'See all',
            'See all Reviews' => 'See all Reviews',
            'Confirm Email' => 'Enter Confirm Email',
            'Password dosen\'t match' => 'Password dosen\'t match',
            'I Consent to the Privacy Policy' => 'I Consent to the Privacy Policy',
            'Continue as Guest' => 'Continue as Guest',
            'username or email' => 'Username or email',
            'Sale Over' => 'Sale Over',
            'Yes Exit' => 'Yes, Exit',
            'You Want to Exit from Application' => 'You Want to Exit from Application',
            'Are You Sure' => 'Are You Sure',
            'Total Price' => 'Total Price',
            'Product Details' => 'Product Details',
            'Select Location' => 'Select Location',
            'SignIn with Social' => 'SignIn with Social',
            'Mobile,Electronics' => 'Mobile,Electronics',
            'Tags' => 'Tags',
            'Beer, Former' => 'Beer, Former',
            'Please wait a moment' => 'Please wait a moment',
            'Item Added Successfully' => 'Item Added Successfully',
            'Items in your cart' => 'Items in your Cart',
            'Item in your cart' => 'Item in your Cart',
            'Remove Successfully' => 'Remove Successfully',
            'Order Amount' => 'Order Amount',
            'Total Amount' => 'Total Amount',
            'Something went wrong' => 'Something went wrong!',
            'Total' => 'Total',
            'Please agree terms condition' => 'Please agree terms condition',
            'Please add new location or press exiting location' => 'Please add new location or press exiting location',
            'Delivery Location' => 'Delivery Location',
            'Add' => 'Add',
            'No Address' => 'No Address',
            'Loading' => 'Loading...',
            'Bill Details' => 'Bill Details',
            'promo code' => 'Promo code',
            'Place Order' => 'Place Order',
            'fees' => 'Fees',
            'free shipping' => 'Free Shipping',
            'home delivery free shipping' => 'Home Delivery Free Shipping',
            'shipping rules based on qty 6 10' => 'Shipping Rules Based on qty(6-10)',
            'home delivery' => 'Home Delivery',
            'Pay With Stripe' => 'Pay With Stripe',
            'Pay With Paypal' => 'Pay With Paypal',
            'Pay With Razorpay' => 'Pay With Razorpay',
            'Pay with Flutter-wave' => 'Pay with Flutter-wave',
            'Pay With Mollie' => 'Pay With Mollie',
            'Pay With InstaMojo' => 'Pay With InstaMojo',
            'Pay With PayStack' => 'Pay With PayStack',
            'Pay with Ssl-commerce' => 'Pay with Ssl-commerce',
            'Please add new location or select exiting location' => 'Please add new location or select exiting location',
            'Please enter bank information' => 'Please enter bank information',
            'Sign-In please' => 'Sign-In please',
            'Order No' => 'Order No',
            'Tracking number' => 'Tracking number',
            'Active' => 'Active',
            'Single Order' => 'Single Order',
            'What is your Rate' => 'What is your Rate',
            'Please write something' => 'Please write something.',
            'Other' => 'Other',
            'Offers' => 'Offers',
            'Items in Your Cart' => 'Items in Your Cart',
            'swipe right to delete any item' => 'Swipe Right to Delete Any Item',
            'My Offers' => 'My Offers',
            'filter' => 'Filter',
            'Size' => 'Size',
            'Find Product' => 'Find Product',
            'All Popular Product' => 'All Popular Product',
            'wishlist added successfully' => 'Wishlist Added Successfully',
            'app info' => 'App Info',
            'Edit Profile' => 'Edit Profile',
            'Your zip-code' => 'Your zip-code',
            'Your address' => 'Your address',
            'Send Us A Message' => 'Send Us A Message',
            'Enter valid email' => 'Enter valid email',
            'Verification Code' => 'Verification Code',
            'Enter Code' => 'Enter Code',
            'I dont received a code' => 'I don’t received a code',
            'Resend' => 'Resend',
            'ecoshop' => 'ShopUs',
            'Buy groceries and feed yourself' => 'Buy groceries and feed yourself',
            'Version' => 'Version',
            'Developed By' => 'Developed By',
            'Dismiss' => 'Dismiss',
            'Confirmation' => 'Confirmation',
            'you wish to delete this address' => 'You wish to delete this address?',
            'delete' => 'Delete',
            'ZipCode' => 'ZipCode',
            'field required' => 'Field required',
            'Enter valid' => 'Enter valid',
            'No Category' => 'No Category',
            'All Seller' => 'All Seller',
            'New Arrival' => 'New Arrival',
            'Best Selling' => 'Best Selling',
            'Discount Products' => 'Discount Products',
            'Highest Price' => 'Highest Price',
            'Low Price' => 'Low Price',
            'Free Delivery' => 'Free Delivery',
            'California' => 'California',
            'Victoria' => 'Victoria',
            'Toronto' => 'Toronto',
            'Become Vendor' => 'Become Vendor',
            'Compare' => 'Compare',
            'Need help' => 'Need help? Call us',
            'My Market Category' => 'My Market Category',
            'Edit Address' => 'Edit Address',
            'Skip for Now' => 'Skip for Now',
        );

        $setting = Setting::select("logo", "favicon", "enable_user_register", 'phone_number_required', 'default_phone_code', "enable_multivendor", "text_direction", "timezone", "topbar_phone", "topbar_email", "currency_icon", "currency_name", "show_product_progressbar", "theme_one", "theme_two", "seller_condition")->first();

        $announcementModal = AnnouncementModal::first();
        $productCategories = Category::with("activeSubCategories.activeChildCategories")->where(["status" => 1])
            ->select("id", "name", "slug", "icon", "image")
            ->get();

        $megaMenuCategories = MegaMenuCategory::with("category", "subCategories.subCategory")->orderBy("serial", "asc")->where("status", 1)->get();

        $megaMenuBanner = BannerImage::find(23);

        $customPages = CustomPage::where("status", 1)->get();

        $googleAnalytic = GoogleAnalytic::first();

        $facebookPixel = FacebookPixel::first();

        $tawk_setting = TawkChat::first();

        $tawk_setting = (object) [
            "status" => $tawk_setting->status,
            "widget_id" => $tawk_setting->widget_id,
            "property_id" => $tawk_setting->property_id,
        ];

        $maintainance_text = MaintainanceText::first();
        $cookie_consent = CookieConsent::first();
        $flashSale = FlashSale::select("status", "offer", "end_time")->first();
        $flashSaleProducts = FlashSaleProduct::where("status", 1)
            ->select("product_id")
            ->get();

        $flashSaleActive = $flashSale->status == 1 ? true : false;
        $seo_setting = SeoSetting::all();
        $shop_page = ShopPage::first();
        $filter_price_range = $shop_page->filter_price_range;
        $first_col_links = FooterLink::where("column", 1)->get();
        $footer = Footer::first();
        $columnTitle = $footer->first_column;
        $footer_first_col = [
            "col_links" => $first_col_links,
            "columnTitle" => $columnTitle,
        ];

        $footer_first_col = (object) $footer_first_col;
        $second_col_links = FooterLink::where("column", 2)->get();
        $columnTitle = $footer->second_column;
        $footer_second_col = [
            "col_links" => $second_col_links,
            "columnTitle" => $columnTitle,
        ];

        $footer_second_col = (object) $footer_second_col;
        $third_col_links = FooterLink::where("column", 3)->get();
        $columnTitle = $footer->third_column;

        $footer_third_col = [
            "col_links" => $third_col_links,
            "columnTitle" => $columnTitle,
        ];

        $footer_third_col = (object) $footer_third_col;
        $social_links = FooterSocialLink::all();
        $login_page = BannerImage::select("image")
            ->whereId("13")
            ->first();

        $recaptchaSetting = GoogleRecaptcha::first();
        $errorPage = ErrorPage::find(1);
        $image_content = Setting::select(
            "empty_cart",
            "empty_wishlist",
            "change_password_image",
            "become_seller_avatar",
            "become_seller_banner"
        )->first();

        $serviceVisibilty = HomePageOneVisibility::find(2);
        $services = Service::where("status", 1)
            ->get()
            ->take($serviceVisibilty->qty);

        $serviceVisibilty = $serviceVisibilty->status == 1 ? true : false;

        $defaultProfile = BannerImage::whereId("15")
            ->select("image")
            ->first();

        return response()->json([
            "language" => $language,
            "setting" => $setting,
            "defaultProfile" => $defaultProfile,
            "flashSaleActive" => $flashSaleActive,
            "flashSale" => $flashSale,
            "flashSaleProducts" => $flashSaleProducts,
            "announcementModal" => $announcementModal,
            "productCategories" => $productCategories,
            "megaMenuCategories" => $megaMenuCategories,
            "megaMenuBanner" => $megaMenuBanner,
            "customPages" => $customPages,
            "googleAnalytic" => $googleAnalytic,
            "facebookPixel" => $facebookPixel,
            "tawk_setting" => $tawk_setting,
            "maintainance_text" => $maintainance_text,
            "cookie_consent" => $cookie_consent,
            "seo_setting" => $seo_setting,
            "filter_price_range" => $filter_price_range,
            "serviceVisibilty" => $serviceVisibilty,
            "services" => $services,
            "footer_first_col" => $footer_first_col,
            "footer_second_col" => $footer_second_col,
            "footer_third_col" => $footer_third_col,
            "footer" => $footer,
            "social_links" => $social_links,
            "login_page_image" => $login_page,
            "recaptchaSetting" => $recaptchaSetting,
            "errorPage" => $errorPage,
            "image_content" => $image_content,
        ]);
    }



    public function subCategoriesByCategory($id)
    {
        $subCategories = SubCategory::where([
            "category_id" => $id,
            "status" => 1,
        ])->get();

        return response()->json(["subCategories" => $subCategories]);
    }

    public function childCategoriesBySubCategory($id)
    {
        $childCategories = ChildCategory::where([
            "sub_category_id" => $id,
            "status" => 1,
        ])->get();

        return response()->json(["childCategories" => $childCategories]);
    }

    public function categoryList()
    {
        $categories = Category::where("status", 1)->get();
        return response()->json(["categories" => $categories]);
    }

    public function category($id)
    {
        $category = Category::find($id);
        return response()->json(["category" => $category]);
    }

    public function subCategory($id)
    {
        $sub_category = SubCategory::find($id);
        return response()->json(["sub_category" => $sub_category]);
    }


    public function childCategory($id)
    {
        $child_category = ChildCategory::find($id);
        return response()->json(["child_category" => $child_category]);
    }

    public function productByCategory($id)
    {
        $category = Category::find($id);
        $products = Product::with("activeVariants.activeVariantItems")->where([
            "category_id" => $id, "status" => 1, "approve_by_admin" => 1,
        ])->select("id", "name", "short_name", "slug", "thumb_image", "qty", "sold_qty", "price", "offer_price", "is_undefine", "is_featured", "new_product", "is_top", "is_best", "category_id", "sub_category_id", "child_category_id", "brand_id")->orderBy("id", "desc")->get();

        return response()->json([
            "category" => $category,
            "products" => $products,
        ]);
    }

    public function index()
    {
        $sliderVisibilty = HomePageOneVisibility::find(1);
        $sliders = Slider::orderBy("serial", "asc")
            ->where(["status" => 1])
            ->get()
            ->take($sliderVisibilty->qty);

        $sliderVisibilty = $sliderVisibilty->status == 1 ? true : false;

        $threeColFirstBanner = BannerImage::whereId("16")->select("image", "id", "banner_location", "title_one", "title_two", "product_slug", "status")->first();

        $threeColSecondBanner = BannerImage::whereId("17")->select("image", "id", "banner_location", "status", "title_one", "title_two", "product_slug")->first();

        $threeColThirdBanner = BannerImage::whereId("18")
            ->select(
                "image",
                "id",
                "banner_location",
                "status",
                "title_one",
                "title_two",
                "product_slug"
            )
            ->first();

        $popularCategoryVisibilty = HomePageOneVisibility::find(4);
        $popularCategories = PopularCategory::with("category")->get();
        $category_arr = [];

        foreach ($popularCategories as $popularCategory) {
            $category_arr[] = $popularCategory->category_id;
        }

        $setting = Setting::first();
        $popularCategoryProducts = Product::with(
            "activeVariants.activeVariantItems"
        )
            ->select(
                "id",
                "name",
                "short_name",
                "slug",
                "thumb_image",
                "qty",
                "sold_qty",
                "price",
                "offer_price",
                "is_undefine",
                "is_featured",
                "new_product",
                "is_top",
                "is_best",
                "category_id",
                "sub_category_id",
                "child_category_id",
                "brand_id"
            )
            ->whereIn("category_id", $category_arr)
            ->where("status", 1)
            ->where("approve_by_admin", 1)
            ->orderBy("id", "desc")
            ->get()
            ->take($popularCategoryVisibilty->qty);

        $popularCategoryVisibilty = $popularCategoryVisibilty->status == 1 ? true : false;
        $popularCategorySidebarBanner = $setting->popular_category_banner;

        $brandVisibility = HomePageOneVisibility::find(5);

        $brands = Brand::where(["status" => 1])
            ->get()
            ->take($brandVisibility->qty);

        $brandVisibility = $brandVisibility->status == 1 ? true : false;

        $flashSale = FlashSale::first();

        $flashSaleSidebarBanner = BannerImage::select(
            "id",
            "link as play_store",
            "image",
            "banner_location",
            "status",
            "title as app_store"
        )->find(24);

        $topRatedVisibility = HomePageOneVisibility::find(6);
        $topRatedProducts = Product::with("activeVariants.activeVariantItems")
            ->select("id", "name", "short_name", "slug", "thumb_image", "qty", "sold_qty", "price", "offer_price", "is_undefine", "is_featured", "new_product", "is_top", "is_best", "category_id", "sub_category_id", "child_category_id", "brand_id")
            ->where(["is_top" => 1, "status" => 1, "approve_by_admin" => 1])
            ->orderBy("id", "desc")
            ->get()
            ->take($topRatedVisibility->qty);

        $topRatedVisibility = $topRatedVisibility->status == 1 ? true : false;
        $sellerVisibility = HomePageOneVisibility::find(7);
        $sellers = Vendor::where(["status" => 1])
            ->select("id", "logo", "banner_image", "shop_name", "slug")
            ->get()
            ->take($sellerVisibility->qty);

        $sellerVisibility = $sellerVisibility->status == 1 ? true : false;

        $twoColumnBannerOne = BannerImage::select(
            "id",
            "link",
            "image",
            "banner_location",
            "status",
            "title_one",
            "title_two",
            "badge",
            "product_slug"
        )->find(19);

        $twoColumnBannerTwo = BannerImage::select(
            "id",
            "link",
            "image",
            "banner_location",
            "status",
            "title_one",
            "title_two",
            "badge",
            "product_slug"
        )->find(20);

        $featuredCategorySidebarBanner = $setting->featured_category_banner;

        $featuredProductVisibility = HomePageOneVisibility::find(8);

        $featuredCategories = FeaturedCategory::with("category")->get();

        $category_arr = [];

        foreach ($featuredCategories as $featuredCategory) {
            $category_arr[] = $featuredCategory->category_id;
        }

        $featuredCategoryProducts = Product::with(
            "activeVariants.activeVariantItems"
        )->select(
            "id",
            "name",
            "short_name",
            "slug",
            "thumb_image",
            "qty",
            "sold_qty",
            "price",
            "offer_price",
            "is_undefine",
            "is_featured",
            "new_product",
            "is_top",
            "is_best",
            "category_id",
            "sub_category_id",
            "child_category_id",
            "brand_id"
        )
            ->whereIn("category_id", $category_arr)
            ->where(["status" => 1, "approve_by_admin" => 1])
            ->orderBy("id", "desc")
            ->get()
            ->take($featuredProductVisibility->qty);

        $featuredProductVisibility = $featuredProductVisibility->status == 1 ? true : false;

        $singleBannerOne = BannerImage::select(
            "id",
            "link",
            "image",
            "banner_location",
            "status",
            "title_one",
            "title_two",
            "product_slug"
        )->find(21);

        $newArrivalProductVisibility = HomePageOneVisibility::find(9);
        $newArrivalProducts = Product::with("activeVariants.activeVariantItems")
            ->select(
                "id",
                "name",
                "short_name",
                "slug",
                "thumb_image",
                "qty",
                "sold_qty",
                "price",
                "offer_price",
                "is_undefine",
                "is_featured",
                "new_product",
                "is_top",
                "is_best",
                "category_id",
                "sub_category_id",
                "child_category_id",
                "brand_id"
            )
            ->where([
                "new_product" => 1,
                "status" => 1,
                "approve_by_admin" => 1,
            ])
            ->orderBy("id", "desc")
            ->get()
            ->take($newArrivalProductVisibility->qty);

        $newArrivalProductVisibility = $newArrivalProductVisibility->status == 1 ? true : false;

        $singleBannerTwo = BannerImage::select(
            "id",
            "link",
            "image",
            "banner_location",
            "status",
            "title_one",
            "product_slug"
        )->find(22);

        $bestProductVisibility = HomePageOneVisibility::find(10);

        $bestProducts = Product::with("activeVariants.activeVariantItems")
            ->select(
                "id",
                "name",
                "short_name",
                "slug",
                "thumb_image",
                "qty",
                "sold_qty",
                "price",
                "offer_price",
                "is_undefine",
                "is_featured",
                "new_product",
                "is_top",
                "is_best",
                "category_id",
                "sub_category_id",
                "child_category_id",
                "brand_id"
            )
            ->where(["is_best" => 1, "status" => 1, "approve_by_admin" => 1])
            ->orderBy("id", "desc")
            ->get()
            ->take($bestProductVisibility->qty);

        $bestProductVisibility = $bestProductVisibility->status == 1 ? true : false;

        $subscriptionBanner = BannerImage::select(
            "id",
            "image",
            "banner_location",
            "header",
            "title"
        )->find(27);

        $seoSetting = SeoSetting::find(1);
        $setting = Setting::first();
        $section_title = json_decode($setting->homepage_section_title);
        $homepage_categories = Category::where(["status" => 1])
            ->get()
            ->take(15);

        $flashSale = FlashSale::first();
        $flashSaleProducts = FlashSaleProduct::where("status", 1)->get();
        $product_arr = [];
        foreach ($flashSaleProducts as $flashSaleProduct) {
            $product_arr[] = $flashSaleProduct->product_id;
        }

        $flashsale_products = Product::with("activeVariants.activeVariantItems")
            ->whereIn("id", $product_arr)
            ->orderBy("id", "desc")
            ->where(["status" => 1, "approve_by_admin" => 1])
            ->select(
                "id",
                "name",
                "short_name",
                "slug",
                "thumb_image",
                "qty",
                "sold_qty",
                "price",
                "offer_price",
                "is_undefine",
                "is_featured",
                "new_product",
                "is_top",
                "is_best"
            )
            ->get()
            ->take(10);

        return response()->json([
            "section_title" => $section_title,
            "seoSetting" => $seoSetting,
            "sliderVisibilty" => $sliderVisibilty,
            "sliders" => $sliders,
            "banner_one" => $threeColFirstBanner,
            "banner_two" => $threeColSecondBanner,
            "homepage_categories" => $homepage_categories,
            "popularCategorySidebarBanner" => $popularCategorySidebarBanner,
            "popularCategoryVisibilty" => $popularCategoryVisibilty,
            "popularCategories" => $popularCategories,
            "popularCategoryProducts" => $popularCategoryProducts,
            "brandVisibility" => $brandVisibility,
            "brands" => $brands,
            "flashSale" => $flashSale,
            "flashSaleSidebarBanner" => $flashSaleSidebarBanner,
            "flashsale_products" => $flashsale_products,
            "topRatedVisibility" => $topRatedVisibility,
            "topRatedProducts" => $topRatedProducts,
            "sellerVisibility" => $sellerVisibility,
            "sellers" => $sellers,
            "banner_three" => $twoColumnBannerOne,
            "banner_four" => $twoColumnBannerTwo,
            "featuredProductVisibility" => $featuredProductVisibility,
            "featuredCategorySidebarBanner" => $featuredCategorySidebarBanner,
            "featuredCategories" => $featuredCategories,
            "featuredCategoryProducts" => $featuredCategoryProducts,
            "singleBannerOne" => $singleBannerOne,
            "newArrivalProductVisibility" => $newArrivalProductVisibility,
            "newArrivalProducts" => $newArrivalProducts,
            "bestProductVisibility" => $bestProductVisibility,
            "singleBannerTwo" => $singleBannerTwo,
            "bestProducts" => $bestProducts,
            "subscriptionBanner" => $subscriptionBanner,
        ]);
    }


    public function aboutUs()
    {
        $aboutUs = AboutUs::first();
        $seoSetting = SeoSetting::find(2);
        $testimonials = Testimonial::where(["status" => 1])->get();
        $services = Service::where("status", 1)->get();
        $blogs = PopularPost::with("blog.activeComments")
            ->where("status", 1)
            ->orderBy("id", "desc")
            ->get()
            ->take(10);

        return response()->json([
            "aboutUs" => $aboutUs,
            "seoSetting" => $seoSetting,
            "testimonials" => $testimonials,
            "services" => $services,
            "blogs" => $blogs,
        ]);
    }

    public function contactUs()
    {
        $contact = ContactPage::first();
        $recaptchaSetting = GoogleRecaptcha::first();
        $seoSetting = SeoSetting::find(3);
        return response()->json([
            "contact" => $contact,
            "recaptchaSetting" => $recaptchaSetting,
            "seoSetting" => $seoSetting,
        ]);
    }

    public function sendContactMessage(Request $request)
    {
        $rules = [
            "name" => "required",
            "email" => "required",
            "subject" => "required",
            "message" => "required",
            "g-recaptcha-response" => new Captcha(),
        ];
        $this->validate($request, $rules);
        $setting = Setting::first();
        if ($setting->enable_save_contact_message == 1) {
            $contact = new ContactMessage();
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->subject = $request->subject;
            $contact->phone = $request->phone;
            $contact->message = $request->message;
            $contact->save();
        }
        MailHelper::setMailConfig();
        $template = EmailTemplate::where("id", 2)->first();
        $message = $template->description;
        $subject = $template->subject;
        $message = str_replace("{{name}}", $request->name, $message);
        $message = str_replace("{{email}}", $request->email, $message);
        $message = str_replace("{{phone}}", $request->phone, $message);
        $message = str_replace("{{subject}}", $request->subject, $message);
        $message = str_replace("{{message}}", $request->message, $message);
        Mail::to($setting->contact_email)->send(
            new ContactMessageInformation($message, $subject)
        );

        $notification = trans("Message send successfully");
        return response()->json(["notification" => $notification]);
    }


    public function blog(Request $request)
    {
        $paginateQty = CustomPagination::whereId("1")->first()->qty;

        $blogs = Blog::with("activeComments")
            ->orderBy("id", "desc")
            ->where(["status" => 1]);

        if ($request->search) {
            $blogs = $blogs->where(
                "title",
                "LIKE",
                "%" . $request->search . "%"
            );
        }

        if ($request->category) {
            $category = BlogCategory::where(
                "slug",
                $request->category
            )->first();

            $blogs = $blogs->where("blog_category_id", $category->id);
        }

        $blogs = $blogs->paginate($paginateQty);

        $seoSetting = SeoSetting::find(6);

        return response()->json([
            "blogs" => $blogs,
            "seoSetting" => $seoSetting,
        ]);
    }

    public function blogDetail($slug)
    {
        $blog = Blog::where(["status" => 1, "slug" => $slug])->first();

        $blog->views += 1;
        $blog->save();

        $popularPosts = PopularPost::with("blog")
            ->where(["status" => 1])
            ->get();

        $categories = BlogCategory::where(["status" => 1])->get();

        $recaptchaSetting = GoogleRecaptcha::first();

        $paginateQty = CustomPagination::whereId("4")->first()->qty;

        $activeComments = BlogComment::where("blog_id", $blog->id)
            ->orderBy("id", "desc")
            ->paginate($paginateQty);

        return response()->json([
            "blog" => $blog,
            "popularPosts" => $popularPosts,
            "categories" => $categories,
            "recaptchaSetting" => $recaptchaSetting,
            "activeComments" => $activeComments,
        ]);
    }


    public function blogComment(Request $request)
    {
        $rules = [
            "name" => "required",
            "email" => "required",
            "comment" => "required",
            "blog_id" => "required",
            "g-recaptcha-response" => new Captcha(),
        ];

        $this->validate($request, $rules);

        $comment = new BlogComment();

        $comment->blog_id = $request->blog_id;
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->comment = $request->comment;
        $comment->save();

        $notification = trans("Blog comment submited successfully");
        return response()->json(["message" => $notification], 200);
    }



    public function faq()
    {
        $faqs = FAQ::orderBy("id", "desc")
            ->where("status", 1)
            ->get();

        return response()->json(["faqs" => $faqs]);
    }

    public function trackOrderResponse($id)
    {
        if (!$id) {
            $message = trans("Order id is required");
            return response()->json(["status" => 0, "message" => $message]);
        }

        $order = Order::where("order_id", $id)->first();
        if ($order) {
            return response()->json(["order" => $order]);
        } else {
            $message = trans("Order not found");
            return response()->json(["status" => 0, "message" => $message]);
        }
    }


    public function allCustomPage()
    {
        $pages = CustomPage::where(["status" => 1])->get();
        return response()->json(["pages" => $pages]);
    }

    public function customPage($slug)
    {
        $page = CustomPage::where(["slug" => $slug, "status" => 1])->first();
        return response()->json(["page" => $page]);
    }

    public function termsAndCondition()
    {
        $terms_conditions = TermsAndCondition::select(
            "terms_and_condition"
        )->first();

        return response()->json(["terms_conditions" => $terms_conditions]);
    }

    public function sellerTemsCondition()
    {
        $seller_tems_conditions = Setting::select("seller_condition")->first();
        return response()->json([
            "seller_tems_conditions" => $seller_tems_conditions,
        ]);
    }

    public function privacyPolicy()
    {
        $privacyPolicy = TermsAndCondition::select("privacy_policy")->first();
        return response()->json(["privacyPolicy" => $privacyPolicy]);
    }

    public function seller()
    {
        $sellers = Vendor::orderBy("id", "desc")
            ->where("status", 1)
            ->select(
                "id",
                "banner_image",
                "shop_name",
                "slug",
                "open_at",
                "closed_at",
                "address",
                "email",
                "logo",
                "phone"
            )
            ->paginate(20);

        $seoSetting = SeoSetting::find(5);

        return response()->json([
            "sellers" => $sellers,
            "seoSetting" => $seoSetting,
        ]);
    }




    public function sellerDetail(Request $request, $shop_name)
    {
        $slug = $shop_name;

        $seller = Vendor::where(["status" => 1, "slug" => $slug])
            ->select(
                "id",
                "banner_image",
                "shop_name",
                "slug",
                "open_at",
                "closed_at",
                "address",
                "email",
                "phone",
                "seo_title",
                "seo_description",
                "logo"
            )
            ->first();

        if (!$seller) {
            return response()->json(["message" => "Seller not found"], 403);
        }

        $searchCategoryArr = [];
        $searchBrandArr = [];
        $categories = Category::with("activeSubCategories.activeChildCategories")
            ->where(["status" => 1])
            ->select("id", "name", "slug", "icon")
            ->get();

        $brands = Brand::where(["status" => 1])
            ->select("id", "name", "slug")
            ->get();

        $activeVariants = ProductVariant::with("activeVariantItems")
            ->select("name", "id")
            ->groupBy("name")
            ->get();

        $paginateQty = CustomPagination::whereId("2")->first()->qty;

        $products = Product::with("activeVariants.activeVariantItems")
            ->orderBy("id", "desc")
            ->where([
                "status" => 1,
                "vendor_id" => $seller->id,
                "approve_by_admin" => 1,
            ]);

        if ($request->category) {
            $category = Category::where("slug", $request->category)->first();
            $products = $products->where("category_id", $category->id);
            $searchCategoryArr[] = $category->id;
        }

        if ($request->sub_category) {
            $sub_category = SubCategory::where(
                "slug",
                $request->sub_category
            )->first();
            $products = $products->where("sub_category_id", $sub_category->id);
            $searchCategoryArr[] = $sub_category->category_id;
        }

        if ($request->child_category) {
            $child_category = ChildCategory::where(
                "slug",
                $request->child_category
            )->first();
            $products = $products->where(
                "child_category_id",
                $child_category->id
            );
            $searchCategoryArr[] = $child_category->category_id;
        }

        if ($request->brand) {
            $brand = Brand::where("slug", $request->brand)->first();
            $products = $products->where("brand_id", $brand->id);
            $searchBrandArr[] = $brand->id;
        }

        if ($request->search) {
            $products = $products->where(
                "name",
                "LIKE",
                "%" . $request->search . "%"
            );
        }

        $paginateQty = CustomPagination::whereId("2")->first()->qty;

        $products = $products->select(
            "id",
            "name",
            "short_name",
            "slug",
            "thumb_image",
            "qty",
            "sold_qty",
            "price",
            "offer_price",
            "is_undefine",
            "is_featured",
            "new_product",
            "is_top",
            "is_best",
            "category_id",
            "sub_category_id",
            "child_category_id",
            "brand_id"
        );

        $products = $products->paginate($paginateQty);
        $products = $products->appends($request->all());

        $sellerReviewQty = ProductReview::where("status", 1)
            ->where("product_vendor_id", $seller->id)
            ->count();

        $sellerTotalReview = ProductReview::where("status", 1)
            ->where("product_vendor_id", $seller->id)
            ->sum("rating");

        $shopPageCenterBanner = BannerImage::select(
            "link",
            "image",
            "banner_location",
            "status",
            "after_product_qty",
            "title_one",
            "product_slug"
        )->find(25);

        $shopPageSidebarBanner = BannerImage::select(
            "link",
            "image",
            "banner_location",
            "status",
            "title_one",
            "title_two",
            "product_slug"
        )->find(26);

        return response()->json([
            "seller" => $seller,
            "sellerReviewQty" => $sellerReviewQty,
            "sellerTotalReview" => $sellerTotalReview,
            "searchCategoryArr" => $searchCategoryArr,
            "searchBrandArr" => $searchBrandArr,
            "categories" => $categories,
            "brands" => $brands,
            "activeVariants" => $activeVariants,
            "products" => $products,
            "shopPageCenterBanner" => $shopPageCenterBanner,
            "shopPageSidebarBanner" => $shopPageSidebarBanner,
        ]);
    }



    public function variantItemsByVariant($name)
    {
        $variantItemsForSearch = ProductVariantItem::with("product", "variant")
            ->groupBy("name")
            ->select("name", "id")
            ->where("product_variant_name", $name)
            ->get();

        return response()->json([
            "variantItemsForSearch" => $variantItemsForSearch,
        ]);
    }

    public function product(Request $request)
    {
        $searchCategoryArr = [];
        $searchBrandArr = [];

        $categories = Category::with("activeSubCategories.activeChildCategories")
            ->where(["status" => 1])
            ->select("id", "name", "slug", "icon")
            ->get();

        $brands = Brand::where(["status" => 1])
            ->select("id", "name", "slug")
            ->get();

        $activeVariants = ProductVariant::with("activeVariantItems")
            ->select("name", "id")
            ->groupBy("name")
            ->get();

        $paginateQty = CustomPagination::whereId("2")->first()->qty;

        $products = Product::with("activeVariants.activeVariantItems")
            ->orderBy("id", "desc")
            ->where(["status" => 1, "approve_by_admin" => 1]);

        if ($request->category) {
            $category = Category::where("slug", $request->category)->first();
            $products = $products->where("category_id", $category->id);
            $searchCategoryArr[] = $category->id;
        }

        if ($request->sub_category) {
            $sub_category = SubCategory::where("slug", $request->sub_category)->first();
            $products = $products->where("sub_category_id", $sub_category->id);
            $searchCategoryArr[] = $sub_category->category_id;
        }

        if ($request->child_category) {
            $child_category = ChildCategory::where("slug", $request->child_category)->first();
            $products = $products->where("child_category_id", $child_category->id);
            $searchCategoryArr[] = $child_category->category_id;
        }

        $popularCategoryArr = [];

        if ($request->highlight) {
            if ($request->highlight == "popular_category") {
                $pop_categories = PopularCategory::all();
                foreach ($pop_categories as $pop_category) {
                    $popularCategoryArr[] = $pop_category->category_id;
                }
                $products = $products->whereIn("category_id", $popularCategoryArr);
            }
        }


        if ($request->highlight == "top_product") {
            $products = $products->where("is_top", 1);
        }

        if ($request->highlight == "new_arrival") {
            $products = $products->where("new_product", 1);
        }

        if ($request->highlight == "featured_product") {
            $products = $products->where("is_featured", 1);
        }

        if ($request->highlight == "best_product") {
            $products = $products->where("is_best", 1);
        }

        if ($request->brand) {
            $brand = Brand::where("slug", $request->brand)->first();
            $products = $products->where("brand_id", $brand->id);
            $searchBrandArr[] = $brand->id;
        }

        if ($request->search) {
            $products = $products->where(
                "name",
                "LIKE",
                "%" . $request->search . "%"
            );
        }

        $products = $products->select(
            "id",
            "name",
            "short_name",
            "slug",
            "thumb_image",
            "qty",
            "sold_qty",
            "price",
            "offer_price",
            "is_undefine",
            "is_featured",
            "new_product",
            "is_top",
            "is_best",
            "category_id",
            "sub_category_id",
            "child_category_id",
            "brand_id"
        );

        $products = $products->paginate($paginateQty);
        $products = $products->appends($request->all());
        $seoSetting = SeoSetting::find(9);

        $shopPageCenterBanner = BannerImage::select(
            "link",
            "image",
            "banner_location",
            "status",
            "after_product_qty",
            "title_one",
            "product_slug"
        )->find(25);

        $shopPageSidebarBanner = BannerImage::select(
            "link",
            "image",
            "banner_location",
            "status",
            "title_one",
            "title_two",
            "product_slug"
        )->find(26);


        return response()->json([
            "searchCategoryArr" => $searchCategoryArr,
            "searchBrandArr" => $searchBrandArr,
            "categories" => $categories,
            "brands" => $brands,
            "activeVariants" => $activeVariants,
            "products" => $products,
            "seoSetting" => $seoSetting,
            "shopPageCenterBanner" => $shopPageCenterBanner,
            "shopPageSidebarBanner" => $shopPageSidebarBanner,
        ]);
    }



    public function searchProduct(Request $request)
    {

        $paginateQty = CustomPagination::whereId("2")->first()->qty;
        if ($request->variantItems) {
            $products = Product::with("activeVariants.activeVariantItems")
                ->whereHas("variantItems", function ($query) use ($request) {
                    $sortArr = [];
                    if ($request->variantItems) {
                        foreach ($request->variantItems as $variantItem) {
                            $sortArr[] = $variantItem;
                        }
                        $query->whereIn("name", $sortArr);
                    }
                })
                ->where("status", 1)
                ->where("approve_by_admin", 1);
        } else {
            $products = Product::with("activeVariants.activeVariantItems")
                ->where("status", 1)
                ->where("approve_by_admin", 1);
        }

        if ($request->shorting_id) {
            if ($request->shorting_id == 1) {
                $products = $products->orderBy("id", "desc");
            } elseif ($request->shorting_id == 2) {
                $products = $products->orderBy("price", "asc");
            } elseif ($request->shorting_id == 3) {
                $products = $products->orderBy("price", "desc");
            }
        } else {
            $products = $products->orderBy("id", "desc");
        }

        if ($request->category) {
            $category = Category::where("slug", $request->category)->first();
            $products = $products->where("category_id", $category->id);
        }

        if ($request->sub_category) {
            $sub_category = SubCategory::where(
                "slug",
                $request->sub_category
            )->first();
            $products = $products->where("sub_category_id", $sub_category->id);
        }



        if ($request->child_category) {
            $child_category = ChildCategory::where(
                "slug",
                $request->child_category
            )->first();

            $products = $products->where(
                "child_category_id",
                $child_category->id
            );
        }

        if ($request->brand) {
            $brand = Brand::where("slug", $request->brand)->first();
            $products = $products->where("brand_id", $brand->id);
        }

        $brandSortArr = [];

        if ($request->brands) {
            foreach ($request->brands as $brand) {
                $brandSortArr[] = $brand;
            }

            $products = $products->whereIn("brand_id", $brandSortArr);
        }

        $categorySortArr = [];
        if ($request->categories) {
            foreach ($request->categories as $brand) {
                $categorySortArr[] = $brand;
            }

            $products = $products->whereIn("category_id", $categorySortArr);
        }

        $popularCategoryArr = [];

        if ($request->highlight) {
            if ($request->highlight == "popular_category") {
                $pop_categories = PopularCategory::all();
                foreach ($pop_categories as $pop_category) {
                    $popularCategoryArr[] = $pop_category->category_id;
                }

                $products = $products->whereIn(
                    "category_id",
                    $popularCategoryArr
                );
            }

            if ($request->highlight == "top_product") {
                $products = $products->where("is_top", 1);
            }

            if ($request->highlight == "new_arrival") {
                $products = $products->where("new_product", 1);
            }

            if ($request->highlight == "featured_product") {
                $products = $products->where("is_featured", 1);
            }

            if ($request->highlight == "best_product") {
                $products = $products->where("is_best", 1);
            }
        }

        if ($request->min_price) {
            if ($request->min_price > 0) {
                $products = $products->where(
                    "price",
                    ">=",
                    $request->min_price
                );
            }
        }

        if ($request->max_price) {
            if ($request->max_price > 0) {
                $products = $products->where(
                    "price",
                    "<=",
                    $request->max_price
                );
            }
        }

        if ($request->shop_name) {
            $slug = $request->shop_name;
            $seller = Vendor::where(["slug" => $slug])->first();
            $products = $products->where("vendor_id", $seller->id);
        }

        if ($request->search) {
            $products = $products
                ->where("name", "LIKE", "%" . $request->search . "%")
                ->orWhere(
                    "long_description",
                    "LIKE",
                    "%" . $request->search . "%"
                );
        }

        $products = $products->select(
            "id",
            "name",
            "short_name",
            "slug",
            "thumb_image",
            "qty",
            "sold_qty",
            "price",
            "offer_price",
            "is_undefine",
            "is_featured",
            "new_product",
            "is_top",
            "is_best",
            "category_id",
            "sub_category_id",
            "child_category_id",
            "brand_id"
        );

        $products = $products->paginate($paginateQty);
        $products = $products->appends($request->all());

        return response()->json(["products" => $products]);
    }

    public function productDetail($slug)
    {
        $product = Product::with(
            "category",
            "brand",
            "activeVariants.activeVariantItems",
            "avgReview"
        )
            ->where(["status" => 1, "slug" => $slug])
            ->first();

        if (!$product) {
            $notification = trans("Something went wrong");
            return response()->json(["message" => $notification], 403);
        }

        $paginateQty = CustomPagination::whereId("5")->first()->qty;
        $productReviews = ProductReview::with("user")
            ->where(["status" => 1, "product_id" => $product->id])
            ->get()
            ->take(10);

        $totalProductReviewQty = ProductReview::where([
            "status" => 1,
            "product_id" => $product->id,
        ])->count();

        $totalReview = ProductReview::where([
            "status" => 1,
            "product_id" => $product->id,
        ])->sum("rating");

        $recaptchaSetting = GoogleRecaptcha::first();

        $relatedProducts = Product::with("activeVariants.activeVariantItems")
            ->where([
                "category_id" => $product->category_id,
                "status" => 1,
                "approve_by_admin" => 1,
            ])
            ->where("id", "!=", $product->id)
            ->get()
            ->take(10);

        $defaultProfile = BannerImage::whereId("15")
            ->select("image")
            ->first();

        $specifications = ProductSpecification::with("key")
            ->where("product_id", $product->id)
            ->get();

        $gellery = ProductGallery::where("product_id", $product->id)->get();

        $is_seller_product = $product->vendor_id == 0 ? false : true;

        $this_seller_products = [];

        if ($is_seller_product) {
            $this_seller_products = Product::with(
                "activeVariants.activeVariantItems"
            )
                ->where([
                    "vendor_id" => $product->vendor_id,
                    "status" => 1,
                    "approve_by_admin" => 1,
                ])
                ->where("id", "!=", $product->id)
                ->get()
                ->take(10);
        }

        $seller = Vendor::with("user")
            ->where("id", $product->vendor_id)
            ->first();

        $sellerTotalProducts = 0;

        if ($is_seller_product) {
            $sellerTotalProducts = Product::with(
                "activeVariants.activeVariantItems"
            )
                ->where([
                    "status" => 1,
                    "vendor_id" => $product->vendor_id,
                    "approve_by_admin" => 1,
                ])
                ->count();
        }

        $sellerReviewQty = 0;
        if ($is_seller_product) {
            $sellerReviewQty = ProductReview::where([
                "status" => 1,
                "product_vendor_id" => $product->vendor_id,
            ])->count();
        }

        $sellerTotalReview = 0;
        if ($is_seller_product) {
            $sellerTotalReview = ProductReview::where([
                "status" => 1,
                "product_vendor_id" => $product->vendor_id,
            ])->sum("rating");
        }

        $tagArray = json_decode($product->tags);
        $tags = "";

        if ($product->tags) {
            foreach ($tagArray as $index => $tag) {
                $tags .= $tag->value . ",";
            }
        }

        return response()->json([
            "product" => $product,
            "gellery" => $gellery,
            "tags" => $tags,
            "totalProductReviewQty" => $totalProductReviewQty,
            "totalReview" => $totalReview,
            "productReviews" => $productReviews,
            "specifications" => $specifications,
            "recaptchaSetting" => $recaptchaSetting,
            "relatedProducts" => $relatedProducts,
            "defaultProfile" => $defaultProfile,
            "is_seller_product" => $is_seller_product,
            "seller" => $seller,
            "sellerTotalProducts" => $sellerTotalProducts,
            "this_seller_products" => $this_seller_products,
            "sellerReviewQty" => $sellerReviewQty,
            "sellerTotalReview" => $sellerTotalReview,
        ]);
    }

    public function productReviewList($id)
    {
        $reviews = ProductReview::with("user")
            ->where(["product_id" => $id, "status" => 1])
            ->paginate(10);

        return response()->json(["reviews" => $reviews]);
    }

    public function addToCompare($id)
    {
        $compare_array = [];
        foreach (Cart::instance("compare")->content() as $content) {
            $compare_array[] = $content->id;
        }

        if (3 <= Cart::instance("compare")->count()) {
            $notification = trans("Already 3 items added");
            return response()->json([
                "status" => 0,
                "message" => $notification,
            ]);
        }

        if (in_array($id, $compare_array)) {
            $notification = trans("Already added this item");
            return response()->json([
                "status" => 0,
                "message" => $notification,
            ]);
        } else {
            $product = Product::with("tax")->find($id);
            $data = [];
            $data["id"] = $id;
            $data["name"] = "abc";
            $data["qty"] = 1;
            $data["price"] = 1;
            $data["weight"] = 1;
            $data["options"]["product"] = $product;
            Cart::instance("compare")->add($data);
            $notification = trans("Item added successfully");
            return response()->json([
                "status" => 1,
                "message" => $notification,
            ]);
        }
    }

    public function compare()
    {
        $banner = BreadcrumbImage::where(["id" => 6])->first();
        $compare_contents = Cart::instance("compare")->content();
        $currencySetting = Setting::first();

        return view("compare", compact("banner", "compare_contents", "currencySetting"));
    }

    public function removeCompare($id)
    {
        Cart::instance("compare")->remove($id);
        $notification = trans("Item remmoved successfully");

        $notification = ["messege" => $notification, "alert-type" => "success"];

        return redirect()
            ->back()
            ->with($notification);
    }

    public function flashSale()
    {
        $flashSale = FlashSale::first();
        $flashSaleProducts = FlashSaleProduct::where("status", 1)->get();
        $product_arr = [];
        foreach ($flashSaleProducts as $flashSaleProduct) {
            $product_arr[] = $flashSaleProduct->product_id;
        }

        $paginateQty = CustomPagination::whereId("2")->first()->qty;
        $products = Product::with("activeVariants.activeVariantItems")
            ->whereIn("id", $product_arr)
            ->orderBy("id", "desc")
            ->where(["status" => 1, "approve_by_admin" => 1])
            ->select(
                "id",
                "name",
                "short_name",
                "slug",
                "thumb_image",
                "qty",
                "sold_qty",
                "price",
                "offer_price",
                "is_undefine",
                "is_featured",
                "new_product",
                "is_top",
                "is_best"
            )
            ->paginate($paginateQty);

        $seoSetting = SeoSetting::find(8);

        return response()->json([
            "flashSale" => $flashSale,
            "products" => $products,
            "seoSetting" => $seoSetting,
        ]);
    }

    public function subscribeRequest(Request $request)
    {
        if ($request->email != null) {
            $isExist = Subscriber::where("email", $request->email)->count();
            if ($isExist == 0) {
                $subscriber = new Subscriber();
                $subscriber->email = $request->email;
                $subscriber->verified_token = random_int(100000, 999999);
                $subscriber->save();

                MailHelper::setMailConfig();
                $template = EmailTemplate::where("id", 3)->first();
                $message = $template->description;
                $subject = $template->subject;

                Mail::to($subscriber->email)->send(
                    new SubscriptionVerification(
                        $subscriber,
                        $message,
                        $subject
                    )
                );

                return response()->json([
                    "message" => trans(
                        "Subscription successfully, please verified your email"
                    ),
                ]);
            } else {
                return response()->json(
                    ["message" => trans("Email already exist"), 403],
                    403
                );
            }
        } else {
            return response()->json(
                ["message" => trans("Email Field is required")],
                403
            );
        }
    }

    public function subscriberVerifcation(Request $request, $token)
    {
        $subscriber = Subscriber::where([
            "verified_token" => $token,
            "email" => $request->email,
        ])->first();

        if ($subscriber) {
            $subscriber->verified_token = null;
            $subscriber->is_verified = 1;
            $subscriber->save();

            $setting = Setting::first();
            $frontend_url = $setting->frontend_url;

            return redirect($frontend_url);
        } else {
            $setting = Setting::first();
            $frontend_url = $setting->frontend_url;

            return redirect($frontend_url);
        }
    }
}