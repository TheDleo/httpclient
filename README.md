### A standardized http client request and response interface

In working with the many remote API's that we deal with at Food for the Hungry, it became obvious that we need to standardize on our http client interface, if for nothing else just to make unit testing easier.

The idea is that we will implement a wrapper class for a number of client libraries such as Buzz, Guzzle, Request, etc as we see the need for a new library.

This code was originally based on [this project](https://github.com/payment/httpclient) which was based upon a pull request for an HttpClient PSR (https://github.com/beberlei/fig-standards/blob/829ecc1e2498883bbb73e7183fcb9728a3051049/proposed/http-client.md)
