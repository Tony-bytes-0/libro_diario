export const deleteArrayObjectProperty = (arrayOfObjects, propertyToDelete) => {
    const newArray = arrayOfObjects.map((obj) => {
        const { [propertyToDelete]: deletedProperty, ...rest } = obj;
        return rest;
    });
    return newArray;
};
