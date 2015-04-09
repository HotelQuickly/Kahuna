# Kahuna

### Installation

```sh
$ composer require hotel-quickly/kahuna:@dev
```

### Configuration
Add this to your neon
```yml
parameters:
	kahuna:
		apiBaseUrl: https://tap-nexus.appspot.com/api
		authUsername: abc #sandbox
		authPassword: abc #sandbox
		isSandbox: true
services:
	- HQ\Kahuna\RequestFactory(%kahuna%)
```

### Usage
```php
/** @var \HQ\Kahuna\RequestFactory */
private $kahunaRequestFactory;

/** @var \HQ\Kahuna\Sender */
private $kahunaSender;

$request = $this->kahunaRequestFactory
    ->create(\HQ\Kahuna\RequestFactory::PUSH)
    ->setPayload('john.doe@gmail.com', 'Hello test push!');
$response = $this->kahunaSender->send($request);
```

### How to add new Request
- 1) Create new file and extends from `RequestAbstract` class
- 2) Add new const of request name to `RequestFactory` class

### How to test
```sh
$ ./vendor/bin/tester tests/
```

### The MIT License (MIT)
Copyright (c) 2014 Hotel Quickly Ltd.

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
