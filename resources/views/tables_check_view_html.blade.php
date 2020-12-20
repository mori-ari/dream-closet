
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tables</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://getbootstrap.com/docs/4.0/examples/dashboard/dashboard.css" rel="stylesheet">
</head>

<body>
<h1>Tables</h1>
    <div class="container-fluid">
        <div class="row">
            
                


                <!-- table[Start] --><div class="col-md-3"><h2 class="info">users</h2><h5>[ ]</h5><div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered">
                            <thead>
                            <tr class="bg-primary text-white">
                                <th>-</th>
                                <th>Name(Type Size)</th>
                                <th>Comment</th>
                            </tr>
                            </thead>

                            <tbody>
                            <!-- TR --><tr><td>1</td><td>bigIncrements('id');
</td><td></td></tr><tr><td>2</td><td>string('name');
</td><td></td></tr><tr><td>3</td><td>string('email');
</td><td></td></tr><tr><td>4</td><td>timestamp('email_verified_at')->nullable();
</td><td></td></tr><tr><td>5</td><td>string('password');
</td><td></td></tr><tr><td>6</td><td>string('remember_token',100);
</td><td></td></tr><tr><td>7</td><td>timestamps();
</td><td></td></tr><tr><td>8</td><td>unique('email');
</td><td></td></tr><!-- TR -->
                            </tbody>

                        </table>
                    </div>
                     </div>
                    <!-- table[end] --><div class="col-md-3"><h2 class="info">password_resets</h2><h5>[ ]</h5><div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered">
                            <thead>
                            <tr class="bg-primary text-white">
                                <th>-</th>
                                <th>Name(Type Size)</th>
                                <th>Comment</th>
                            </tr>
                            </thead>

                            <tbody>
                            <!-- TR --><tr><td>1</td><td>string('email');
</td><td></td></tr><tr><td>2</td><td>string('token');
</td><td></td></tr><tr><td>3</td><td>timestamp('created_at')->nullable();
</td><td></td></tr><tr><td>4</td><td>index('email');
</td><td></td></tr><!-- TR -->
                            </tbody>

                        </table>
                    </div>
                     </div>
                    <!-- table[end] --><div class="col-md-3"><h2 class="info">failed_jobs</h2><h5>[ ]</h5><div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered">
                            <thead>
                            <tr class="bg-primary text-white">
                                <th>-</th>
                                <th>Name(Type Size)</th>
                                <th>Comment</th>
                            </tr>
                            </thead>

                            <tbody>
                            <!-- TR --><tr><td>1</td><td>bigIncrements('id');
</td><td></td></tr><tr><td>2</td><td>text('connection');
</td><td></td></tr><tr><td>3</td><td>text('queue');
</td><td></td></tr><tr><td>4</td><td>longText('payload');
</td><td></td></tr><tr><td>5</td><td>longText('exception');
</td><td></td></tr><tr><td>6</td><td>timestamp('failed_at')->useCurrent();
</td><td></td></tr><!-- TR -->
                            </tbody>

                        </table>
                    </div>
                     </div>
                    <!-- table[end] --><div class="col-md-3"><h2 class="info">posts</h2><h5>[ ]</h5><div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered">
                            <thead>
                            <tr class="bg-primary text-white">
                                <th>-</th>
                                <th>Name(Type Size)</th>
                                <th>Comment</th>
                            </tr>
                            </thead>

                            <tbody>
                            <!-- TR --><tr><td>1</td><td>increments('id');
</td><td></td></tr><tr><td>2</td><td>string('uid',20)->nullable();
</td><td></td></tr><tr><td>3</td><td>string('title',255)->nullable();
</td><td></td></tr><tr><td>4</td><td>text('img1')->nullable();
</td><td></td></tr><tr><td>5</td><td>text('img2')->nullable();
</td><td></td></tr><tr><td>6</td><td>text('img3')->nullable();
</td><td></td></tr><tr><td>7</td><td>text('img4')->nullable();
</td><td></td></tr><tr><td>8</td><td>text('img5')->nullable();
</td><td></td></tr><tr><td>9</td><td>text('img6')->nullable();
</td><td></td></tr><tr><td>10</td><td>text('url1')->nullable();
</td><td></td></tr><tr><td>11</td><td>text('url2')->nullable();
</td><td></td></tr><tr><td>12</td><td>text('url3')->nullable();
</td><td></td></tr><tr><td>13</td><td>text('url4')->nullable();
</td><td></td></tr><tr><td>14</td><td>text('url5')->nullable();
</td><td></td></tr><tr><td>15</td><td>text('url6')->nullable();
</td><td></td></tr><tr><td>16</td><td>integer('price1')->nullable();
</td><td></td></tr><tr><td>17</td><td>integer('price2')->nullable();
</td><td></td></tr><tr><td>18</td><td>integer('price3')->nullable();
</td><td></td></tr><tr><td>19</td><td>integer('price4')->nullable();
</td><td></td></tr><tr><td>20</td><td>integer('price5')->nullable();
</td><td></td></tr><tr><td>21</td><td>integer('price6')->nullable();
</td><td></td></tr><tr><td>22</td><td>timestamps();
</td><td></td></tr><tr><td>23</td><td>unique('uid');
</td><td></td></tr><!-- TR -->
                            </tbody>

                        </table>
                    </div>
                     </div>
                    <!-- table[end] --><div class="col-md-3"><h2 class="info">items</h2><h5>[ ]</h5><div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered">
                            <thead>
                            <tr class="bg-primary text-white">
                                <th>-</th>
                                <th>Name(Type Size)</th>
                                <th>Comment</th>
                            </tr>
                            </thead>

                            <tbody>
                            <!-- TR --><tr><td>1</td><td>increments('id');
</td><td></td></tr><tr><td>2</td><td>integer('itemCode');
</td><td></td></tr><tr><td>3</td><td>text('url')->nullable();
</td><td></td></tr><tr><td>4</td><td>text('img')->nullable();
</td><td></td></tr><tr><td>5</td><td>integer('price')->nullable();
</td><td></td></tr><tr><td>6</td><td>integer('genreId')->nullable();
</td><td></td></tr><tr><td>7</td><td>string('genreName')->nullable();
</td><td></td></tr><tr><td>8</td><td>integer('colorId')->nullable();
</td><td></td></tr><tr><td>9</td><td>string('colorName')->nullable();
</td><td></td></tr><tr><td>10</td><td>string('shopName')->nullable();
</td><td></td></tr><tr><td>11</td><td>text('shopUrl')->nullable();
</td><td></td></tr><tr><td>12</td><td>text('itemName')->nullable();
</td><td></td></tr><tr><td>13</td><td>text('caption')->nullable();
</td><td></td></tr><tr><td>14</td><td>timestamps();
</td><td></td></tr><!-- TR -->
                            </tbody>

                        </table>
                    </div>
                     </div>
                    <!-- table[end] --><div class="col-md-3"><h2 class="info">posts_items</h2><h5>[ ]</h5><div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered">
                            <thead>
                            <tr class="bg-primary text-white">
                                <th>-</th>
                                <th>Name(Type Size)</th>
                                <th>Comment</th>
                            </tr>
                            </thead>

                            <tbody>
                            <!-- TR --><tr><td>1</td><td>increments('id');
</td><td></td></tr><tr><td>2</td><td>unsignedInteger('post_id')->nullable()->unsigned();
</td><td></td></tr><tr><td>3</td><td>unsignedInteger('item_id')->nullable()->unsigned();
</td><td></td></tr><tr><td>4</td><td>timestamps();
</td><td></td></tr><tr><td class="bg-secondary text-white">FK</td><td colspan="2">//$table->foreign("post_id")<span class="text-danger">->references("id")->on("posts");</span>
</td></tr></tr><tr><td class="bg-secondary text-white">FK</td><td colspan="2">//$table->foreign("item_id")<span class="text-danger">->references("id")->on("items");</span>
</td></tr></tr><!-- TR -->
                            </tbody>

                        </table>
                    </div>
                     </div>
                    <!-- table[end] --> </main>
        </div>
    </div>
</body>

</html>
