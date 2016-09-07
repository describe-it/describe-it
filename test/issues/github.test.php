<?php

describe('MyOtherClass', function ()
{
    context('Some features', function ()
    {
        it('Should pass', function ()
        {
            expect(true)->equal_to(true);
            expect(true)->equal_to(true);
            expect(true)->equal_to(true);
        });
        it('Should not pass', function ()
        {
            expect(true)->equal_to(true);
            expect(true)->equal_to(false);
            expect(true)->equal_to(false);
        });
    });
});

describe('MyThirdClass', function ()
{
    context('Other features', function ()
    {
        it('Should pass', function ()
        {
            expect(true)->equal_to(true);
            expect(true)->equal_to(true);
            expect(true)->equal_to(true);
        });
        it('Should not pass', function ()
        {
            expect(true)->equal_to(true);
            expect(true)->equal_to(false);
            expect(true)->equal_to(false);
        });
        it('Who cares', function ()
        {
            expect(true)->equal_to(true);
            expect(true)->equal_to(true);
            expect(true)->equal_to(false);
        });
    });
});