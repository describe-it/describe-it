<?php

describe("MyClass", function ()
{
    context("Checking some of it's features", function ()
    {
        it('Should pass', function ()
        {
            expect(true)->to_be->equal_to(true);
            expect(true)->to_be_not->same_as(false);
        });

        it('Should not pass', function ()
        {
            expect(true)->to_be_not->equal_to(true);
            expect(false)->to_be->same_as(true);
        });

        it('And this should pass too!', function ()
        {
            expect(10)->to_be->equal_to(10.0);
        });
    });
});

