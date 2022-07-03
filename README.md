# GateIO PHP API Document.
```
 - Author: Barış Demir github.com/barisdemir49 
 - Web Site: botcex.com
 - GateIO V4: https://www.gate.io/docs/developers/apiv4/en/#spot
 - This coding is only for Gate Io v4

```
```PHP
$API = new GateIO($key, $secret);
```
- # Create Order orderCreate()
```PHP
    $API->orderCreate('SHIB_USDT', 1000000, "0.000019941",'sell')
```
**Result:** 
```PHP
    stdClass Object
    (
        [id] => 176137147516
        [text] => apiv4
        [create_time] => 1656872914
        [update_time] => 1656872914
        [create_time_ms] => 1656872914361
        [update_time_ms] => 1656872914361
        [status] => open
        [currency_pair] => SHIB_USDT
        [type] => limit
        [account] => spot
        [side] => sell
        [amount] => 1000000
        [price] => 0.000019941
        [time_in_force] => gtc
        [iceberg] => 0
        [left] => 1000000
        [fill_price] => 0
        [filled_total] => 0
        [fee] => 0
        [fee_currency] => USDT
        [point_fee] => 0
        [gt_fee] => 0
        [gt_discount] => 
        [rebated_fee] => 0
        [rebated_fee_currency] => SHIB
    )
```    
- # Get Order getOrder()
## Request
```PHP
  $API->getOrder('176137147516','SHIB_USDT');
```  
**Result:** 
```PHP
   stdClass Object
    (
        [id] => 176137147516
        [text] => apiv4
        [create_time] => 1656872914
        [update_time] => 1656872914
        [create_time_ms] => 1656872914383
        [update_time_ms] => 1656872914383
        [status] => open
        [currency_pair] => SHIB_USDT
        [type] => limit
        [account] => spot
        [side] => sell
        [amount] => 1000000
        [price] => 0.000019941
        [time_in_force] => gtc
        [iceberg] => 0
        [left] => 1000000
        [fill_price] => 0
        [filled_total] => 0
        [fee] => 0
        [fee_currency] => USDT
        [point_fee] => 0
        [gt_fee] => 0
        [gt_discount] => 
        [rebated_fee] => 0
        [rebated_fee_currency] => SHIB
    )
```
- # Gets Open Orders getOpenOrders()
## Request
### All
```PHP
    $API->getOpenOrders() 
```    
**Result:**
```PHP
    Array
    (
        [0] => stdClass Object
            (
                [currency_pair] => SHIB_USDT
                [total] => 1
                [orders] => Array
                    (
                        [0] => stdClass Object
                            (
                                [id] => 176137147516
                                [text] => apiv4
                                [create_time] => 1656872914
                                [update_time] => 1656872914
                                [create_time_ms] => 1656872914379
                                [update_time_ms] => 1656872914379
                                [status] => open
                                [currency_pair] => SHIB_USDT
                                [type] => limit
                                [account] => spot
                                [side] => sell
                                [amount] => 1000000
                                [price] => 0.000019941
                                [time_in_force] => gtc
                                [iceberg] => 0
                                [left] => 1000000
                                [fill_price] => 0
                                [filled_total] => 0
                                [fee] => 0
                                [fee_currency] => USDT
                                [point_fee] => 0
                                [gt_fee] => 0
                                [gt_discount] => 
                                [rebated_fee] => 0
                                [rebated_fee_currency] => SHIB
                            )

                    )

            )

    )
```

### Currency and limit filter
```PHP
    $API->getOpenOrders('SHIB_USDT',10) 
```    
**Result:**    
```PHP   
    Array
    (
        [0] => stdClass Object
            (
                [id] => 176144058924
                [text] => apiv4
                [create_time] => 1656875263
                [update_time] => 1656875263
                [create_time_ms] => 1656875263507
                [update_time_ms] => 1656875263507
                [status] => open
                [currency_pair] => SHIB_USDT
                [type] => limit
                [account] => spot
                [side] => sell
                [amount] => 1000000
                [price] => 0.000020941
                [time_in_force] => gtc
                [iceberg] => 0
                [left] => 1000000
                [fill_price] => 0
                [filled_total] => 0
                [fee] => 0
                [fee_currency] => USDT
                [point_fee] => 0
                [gt_fee] => 0
                [gt_discount] => 
                [rebated_fee] => 0
                [rebated_fee_currency] => SHIB
            )

    )
```
- # Cancel Order cancelOrder()
## Request
```PHP
    $API->cancelOrder('176144088956','SHIB_USDT');
```    
**Result:**
```PHP
    stdClass Object
    (
        [id] => 176144088956
        [text] => apiv4
        [create_time] => 1656875274
        [update_time] => 1656875521
        [create_time_ms] => 1656875274561
        [update_time_ms] => 1656875521283
        [status] => cancelled
        [currency_pair] => SHIB_USDT
        [type] => limit
        [account] => spot
        [side] => sell
        [amount] => 1000000
        [price] => 0.000021941
        [time_in_force] => gtc
        [iceberg] => 0
        [left] => 1000000
        [fill_price] => 0
        [filled_total] => 0
        [fee] => 0
        [fee_currency] => USDT
        [point_fee] => 0
        [gt_fee] => 0
        [gt_discount] => 
        [rebated_fee] => 0
        [rebated_fee_currency] => SHIB
    )
```
- # Get Finished Orders getFinishedOrders()
## Request
```PHP
    $API->getFinishedOrders()
```    
**Result:**
```PHP
    Array
        (
            [0] => stdClass Object
                (
                    [id] => 174478375468
                    [text] => 101
                    [create_time] => 1656483046
                    [update_time] => 1656483050
                    [create_time_ms] => 1656483046788
                    [update_time_ms] => 1656483050337
                    [status] => closed
                    [currency_pair] => SHIB_USDT
                    [type] => limit
                    [account] => spot
                    [side] => buy
                    [amount] => 3137682
                    [price] => 9.783e-06
                    [time_in_force] => gtc
                    [iceberg] => 0
                    [left] => 0
                    [fill_price] => 30.695943006
                    [filled_total] => 30.695943006
                    [fee] => 5647.8276
                    [fee_currency] => SHIB
                    [point_fee] => 0
                    [gt_fee] => 0
                    [gt_discount] => 
                    [rebated_fee_currency] => USDT
                )

            [1] => stdClass Object
                (
                    [id] => 174478308991
                    [text] => 101
                    [create_time] => 1656483028
                    [update_time] => 1656483042
                    [create_time_ms] => 1656483028529
                    [update_time_ms] => 1656483042219
                    [status] => cancelled
                    [currency_pair] => SHIB_USDT
                    [type] => limit
                    [account] => spot
                    [side] => buy
                    [amount] => 3140893
                    [price] => 9.773e-06
                    [time_in_force] => gtc
                    [iceberg] => 0
                    [left] => 3140893
                    [fill_price] => 0
                    [filled_total] => 0
                    [fee] => 0
                    [fee_currency] => SHIB
                    [point_fee] => 0
                    [gt_fee] => 0
                    [gt_discount] => 
                    [rebated_fee_currency] => USDT
                )

            [2] => stdClass Object
                (
                    [id] => 174478258967
                    [text] => 101
                    [create_time] => 1656483016
                    [update_time] => 1656483023
                    [create_time_ms] => 1656483016870
                    [update_time_ms] => 1656483023619
                    [status] => cancelled
                    [currency_pair] => SHIB_USDT
                    [type] => limit
                    [account] => spot
                    [side] => buy
                    [amount] => 3141793
                    [price] => 9.7702e-06
                    [time_in_force] => gtc
                    [iceberg] => 0
                    [left] => 3141793
                    [fill_price] => 0
                    [filled_total] => 0
                    [fee] => 0
                    [fee_currency] => SHIB
                    [point_fee] => 0
                    [gt_fee] => 0
                    [gt_discount] => 
                    [rebated_fee_currency] => USDT
                )

            [3] => stdClass Object
                (
                    [id] => 174478065015
                    [text] => 101
                    [create_time] => 1656482964
                    [update_time] => 1656483003
                    [create_time_ms] => 1656482964215
                    [update_time_ms] => 1656483003757
                    [status] => cancelled
                    [currency_pair] => SHIB_USDT
                    [type] => limit
                    [account] => spot
                    [side] => buy
                    [amount] => 3147269
                    [price] => 9.7532e-06
                    [time_in_force] => gtc
                    [iceberg] => 0
                    [left] => 3147269
                    [fill_price] => 0
                    [filled_total] => 0
                    [fee] => 0
                    [fee_currency] => SHIB
                    [point_fee] => 0
                    [gt_fee] => 0
                    [gt_discount] => 
                    [rebated_fee_currency] => USDT
                )

            [4] => stdClass Object
                (
                    [id] => 174477747455
                    [text] => 101
                    [create_time] => 1656482897
                    [update_time] => 1656482897
                    [create_time_ms] => 1656482897319
                    [update_time_ms] => 1656482897341
                    [status] => closed
                    [currency_pair] => LUNA_USDT
                    [type] => limit
                    [account] => spot
                    [side] => sell
                    [amount] => 3.552
                    [price] => 2.5387
                    [time_in_force] => gtc
                    [iceberg] => 0
                    [left] => 0.000
                    [fill_price] => 9.0174624
                    [filled_total] => 9.0174624
                    [fee] => 0.01623143232
                    [fee_currency] => USDT
                    [point_fee] => 0
                    [gt_fee] => 0
                    [gt_discount] => 
                    [rebated_fee_currency] => LUNA
                )

            [5] => stdClass Object
                (
                    [id] => 174477620241
                    [text] => 101
                    [create_time] => 1656482875
                    [update_time] => 1656482875
                    [create_time_ms] => 1656482875959
                    [update_time_ms] => 1656482875959
                    [status] => closed
                    [currency_pair] => LUNC_USDT
                    [type] => limit
                    [account] => spot
                    [side] => sell
                    [amount] => 170678.21
                    [price] => 0.0001273
                    [time_in_force] => gtc
                    [iceberg] => 0
                    [left] => 0.00
                    [fill_price] => 21.7290429151
                    [filled_total] => 21.7290429151
                    [fee] => 0.03911227724718
                    [fee_currency] => USDT
                    [point_fee] => 0
                    [gt_fee] => 0
                    [gt_discount] => 
                    [rebated_fee_currency] => LUNC
                )

            [6] => stdClass Object
                (
                    [id] => 174477497318
                    [text] => 101
                    [create_time] => 1656482856
                    [update_time] => 1656482869
                    [create_time_ms] => 1656482856932
                    [update_time_ms] => 1656482869182
                    [status] => cancelled
                    [currency_pair] => LUNC_USDT
                    [type] => limit
                    [account] => spot
                    [side] => sell
                    [amount] => 170678.21
                    [price] => 0.00012839
                    [time_in_force] => gtc
                    [iceberg] => 0
                    [left] => 170678.21
                    [fill_price] => 0
                    [filled_total] => 0
                    [fee] => 0
                    [fee_currency] => USDT
                    [point_fee] => 0
                    [gt_fee] => 0
                    [gt_discount] => 
                    [rebated_fee_currency] => LUNC
                )

        )
```
- # My wallet myWallet()
## All wallet Request
```PHP
    $API->myWallet()
```    
**Result:**

```PHP
    Array
    (
        [0] => stdClass Object
            (
                [currency] => BTC
                [available] => 0.00000028
                [locked] => 0
            )

        [1] => stdClass Object
            (
                [currency] => SHIB
                [available] => 2132034.1724
                [locked] => 1000000
            )

    )
```
## single wallet Request
```PHP
    $API->myWallet('SHIB')
```    
**Result:**
```PHP
    stdClass Object
    (
        [currency] => SHIB
        [available] => 2132034.1724
        [locked] => 1000000
    )
```    
- # Currency Pairs pairs()
## Request  
```PHP   
    $API->pairs('SHIB_USDT');
```    

*Note:* currency null must be sent for all results 

**Result:**
```PHP
    stdClass Object
    (
        [id] => SHIB_USDT
        [base] => SHIB
        [quote] => USDT
        [fee] => 0.2
        [min_quote_amount] => 1
        [amount_precision] => 0
        [precision] => 10
        [trade_status] => tradable
        [sell_start] => 0
        [buy_start] => 0
    ) 
```
### All data
```PHP
     Array
     (
        [2711] => stdClass Object
            (
                [id] => OAX_USDT
                [base] => OAX
                [quote] => USDT
                [fee] => 0.2
                [min_quote_amount] => 1
                [amount_precision] => 3
                [precision] => 6
                [trade_status] => tradable
                [sell_start] => 0
                [buy_start] => 0
            )

        [2712] => stdClass Object
            (
                [id] => DSD_USDT
                [base] => DSD
                [quote] => USDT
                [fee] => 0.2
                [min_quote_amount] => 1
                [amount_precision] => 3
                [precision] => 7
                [trade_status] => untradable
                [sell_start] => 0
                [buy_start] => 0
            )

        [2713] => stdClass Object
            (
                [id] => ALPHR_USDT
                [base] => ALPHR
                [quote] => USDT
                [fee] => 0.2
                [min_quote_amount] => 1
                [amount_precision] => 4
                [precision] => 7
                [trade_status] => tradable
                [sell_start] => 0
                [buy_start] => 0
            )

        )  
```