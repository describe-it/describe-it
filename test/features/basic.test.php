<?php

describe("MyClass", function ()
{
    context("Checking some of it's features", function ()
    {
        it('Should pass', function ()
        {
            expect(true)->equal_to(true);
            expect(true)->equal_to(true);
            expect(1)->same_as(1);
        });

        it('Should not pass', function ()
        {
            expect(true)->equal_to(true);
            expect(true)->equal_to(false);
            expect('a')->same_as('b');
        });
    });
});

