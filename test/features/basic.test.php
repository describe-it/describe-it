<?php

describe("MyClass", function ()
{
    context("Checking some of it's features", function ()
    {
        it('Should pass', function ()
        {
            expect(true)->equal_to(true);
            expect(true)->equal_to(true);
        });

        it('Should not pass', function ()
        {
            expect(true)->equal_to(true);
            expect(true)->equal_to(false);
        });
    });
});

