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
            expect(true)->to_be_not->equal_to(false);
            expect(false)->to_be->same_as(true);
        });
    });
});

