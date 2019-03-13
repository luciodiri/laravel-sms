@extends('layout')

@section('title', 'Users log')

@section('content')
    <div class="title m-b-md">Users Log</div>
    <div>
        <h2>Select your log parameters</h2>
        <div class="form">
            <form method="post">
                {{ csrf_field() }}
                <div class="field">
                    <label class="half" for="date_from">From</label>
                    <input class="half" type="date" name="date_from" min="2019-03-02" max="2019-03-13" required
                           value="<?php echo $search['date_from'] ?? ''; ?>"/>
                </div>
                <div class="field">
                    <label class="half"  for="date_to">To</label>
                    <input class="half"  type="date" name="date_to" min="2019-03-02" max="2019-03-13" required
                           value="<?php echo $search['date_to'] ?? ''; ?>" />
                </div>

                <div class="field">
                    <label class="half" for="user">Select User (optional)</label>
                    <select class="half"  name="user">
                        <option value="0">All</option>
                        <?php foreach ($users as $user) {
                          echo "<option value='$user->usr_id' ";
                                if (isset($search)) {
                                    echo $search['user'] == $user->usr_id ? 'selected' : '';
                                }

                          echo  ">$user->usr_name</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="field">
                    <label class="half"  for="country">Select Country (optional)</label>
                    <select class="half"  name="country">
                        <option value="0">All</option>
                        <?php foreach ($countries as $country) {
                            echo "<option value='$country->cnt_id' ";
                            if (isset($search)) {
                                echo $search['country'] == $country->cnt_id ? 'selected' : '';
                            }

                            echo  ">$country->cnt_title</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="center">
                    <input class="submit" type="submit" value="Search log"/>
                </div>
            </form>
        </div>
    </div>

    <!-- Show the logs search results -->
    <table class="table">
        <thead>
            <tr>
                 <th>Date</th>
                <th>Successfully sent</th>
                <th>Failed</th>
            </tr>
        </thead>
        <tbody>
        <?php
            if(isset($results)) {
                foreach ($results as $row ) {
                    echo "<tr>";
                        echo "<td>" . $row->log_date . "</td>";
                        echo "<td>" . $row->success . "</td>";
                        echo "<td>" . $row->failure . "</td>";
                    echo "</tr>";
                }
            }

        ?>
        </tbody>
    </table>
@endsection
