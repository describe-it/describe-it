<?php

describe('MyOtherClass', function ()
{
    context('Some features', function ()
    {

        it('Should pass', function ()
        {
            expect(true)->equal_to(true);
            expect(true)->to_be->type_of('boolean');
        });

        it('Should not pass', function ()
        {
            expect(true)->to_be_not->equal_to(true);
            expect(false)->to_be->type_of('integer');
        });

    });
});
